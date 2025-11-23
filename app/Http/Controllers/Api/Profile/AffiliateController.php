<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\AffiliateHistory;
use App\Models\AffiliateWithdraw;
use App\Models\Bau;
use App\Models\Deposit;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AffiliateController extends Controller
{
    public function index()
    {
        $user = auth('api')->user();
        $indications = User::where('inviter', $user->id)->count();
        $walletDefault = Wallet::where('user_id', $user->id)->first();
        $affiliateBauValue = $user->affiliate_bau_value;

        // Contando os depósitos pagos do próprio usuário
        $paidDepositsCount = Deposit::where('user_id', $user->id)
            ->where('status', 1)
            ->count();

        // Obtendo os usernames dos indicados
        $referralUsernames = User::where('inviter', $user->id)->pluck('name');

        // Obtendo os IDs dos indicados
        $referralIds = User::where('inviter', $user->id)->pluck('inviter_code');

    

    // Obtendo os IDs, usernames e data de cadastro dos indicados
$referralData = User::where('inviter', $user->id)
    ->select('id', 'name', 'created_at', 'last_activity')
    ->withCount(['deposits as totalDeposits' => function ($query) {
        $query->where('status', 1);
    }])
    ->selectRaw("
        CASE 
            WHEN last_activity IS NOT NULL AND TIMESTAMPDIFF(MINUTE, last_activity, NOW()) < 5 THEN 'Online' 
            ELSE 'Offline' 
        END as status
    ")
    ->get();





        // Contando os depósitos dos indicados
        $referralDepositsCount = User::where('inviter', $user->id)
            ->whereHas('deposits', function ($query) {
                $query->where('status', 1);
            })
            ->count();
            

        // Somando todos os depósitos pagos dos indicados
        $totalDepositsFromReferrals = User::where('inviter', $user->id)
            ->with('deposits')
            ->get()
            ->sum(function ($referral) {
                return $referral->deposits->where('status', 1)->sum('amount');
            });

        // Contando quantos indicados não fizeram depósitos
        $nonDepositingReferralsCount = $indications - $referralDepositsCount;

        // Calculando a taxa de conversão
        $conversionRate = $indications > 0 ? ($referralDepositsCount / $indications) * 100 : 0;

        // Total de refer_rewards
        $totalReferRewards = Deposit::where('user_id', $user->id)
            ->where('status', 1)
            ->sum('amount');

        // Obtendo os caminhos das imagens dos baús
        $chestImages = [];
        for ($i = 1; $i <= 13000; $i++) {
            $bau = Bau::where('user_id', $user->id)->where('bau_id', $i)->first();
            $chestImages[$i] = $bau ? $bau->caminho : '/assets/images/big3.png'; // Caminho padrão
        }

        $revenueShare = $user->affiliate_revenue_share;
        $cpa = $user->cpa;

        // Verificando baús ao carregar a página
        $this->verificarTodosBaus($user);

        return response()->json([
            'status' => true,
            'code' => $user->inviter_code,
            'url' => config('app.url') . '/?code=' . $user->inviter_code,
            'indications' => $indications,
            'paidDepositsCount' => $paidDepositsCount,
            'referralDepositsCount' => $referralDepositsCount,
            'nonDepositingReferralsCount' => $nonDepositingReferralsCount,
            'conversionRate' => $conversionRate,
            'totalDepositsFromReferrals' => $totalDepositsFromReferrals,
            'totalReferRewards' => $totalReferRewards,
            'revenue_share' => $revenueShare,
            'cpa' => $cpa,
            'wallet' => $walletDefault,
            'bau_value' => $affiliateBauValue,
            'chest_images' => $chestImages,
            'referralIds' => $referralIds, // Adicionando os IDs dos indicados
            'referralUsernames' => $referralUsernames, // Adicionando apenas os usernames dos indicados
            'referralData' => $referralData // Adicionando IDs, usernames e data de cadastro dos indicados
        ]);
    }

    public function generateCode()
    {
        $code = $this->gencode();
        $setting = \Helper::getSetting();

        if (!empty($code)) {
            $user = auth('api')->user();
            \DB::table('model_has_roles')->updateOrInsert(
                [
                    'role_id' => 2,
                    'model_type' => 'App\Models\User',
                    'model_id' => $user->id,
                ],
            );

            if ($user->update(['inviter_code' => $code, 'affiliate_revenue_share' => $setting->revshare_percentage])) {
                return response()->json(['status' => true, 'message' => trans('Successfully generated code')]);
            }

            return response()->json(['error' => ''], 400);
        }

        return response()->json(['error' => ''], 400);
    }

    private function gencode()
    {
        $code = \Helper::generateCode(8);

        $checkCode = User::where('inviter_code', $code)->first();
        if (empty($checkCode)) {
            return $code;
        }

        return $this->gencode();
    }

    public function makeRequest(Request $request)
    {
        $settings = Setting::where('id', 1)->first();
        $withdrawalLimit = $settings->withdrawal_limit ?? null;
        $withdrawalPeriod = $settings->withdrawal_period ?? null;

        if ($withdrawalLimit !== null && $withdrawalPeriod !== null) {
            $startDate = now()->startOfDay();
            $endDate = now()->endOfDay();

            switch ($withdrawalPeriod) {
                case 'weekly':
                    $startDate = now()->startOfWeek();
                    $endDate = now()->endOfWeek();
                    break;
                case 'monthly':
                    $startDate = now()->startOfMonth();
                    $endDate = now()->endOfMonth();
                    break;
                case 'yearly':
                    $startDate = now()->startOfYear();
                    $endDate = now()->endOfYear();
                    break;
            }

            $withdrawalCount = AffiliateWithdraw::where('user_id', auth('api')->user()->id)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count();

            if ($withdrawalCount >= $withdrawalLimit) {
                return response()->json(['message' => 'Você atingiu o limite de saques para este período'], 400);
            }
        }

        $rules = [
            'amount' => ['required', 'numeric', 'min:' . $settings->min_withdrawal, 'max:' . $settings->max_withdrawal],
            'pix_type' => 'required',
        ];

        switch ($request->pix_type) {
            case 'document':
                $rules['pix_key'] = 'required|cpf_ou_cnpj';
                break;
            case 'email':
                $rules['pix_key'] = 'required|email';
                break;
            default:
                $rules['pix_key'] = 'required';
                break;
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $comission = auth('api')->user()->wallet->refer_rewards;

        if (floatval($comission) >= floatval($request->amount) && floatval($request->amount) > 0) {
            AffiliateWithdraw::create([
                'user_id' => auth('api')->id(),
                'amount' => $request->amount,
                'pix_key' => $request->pix_key,
                'pix_type' => $request->pix_type,
                'currency' => 'BRL',
                'symbol' => 'R$',
            ]);

            auth('api')->user()->wallet->decrement('refer_rewards', $request->amount);

            return response()->json(['message' => trans('Commission withdrawal successfully carried out')], 200);
        }

        return response()->json(['message' => trans('Commission withdrawal error')], 400);
    }

    private function getChestConfigs()
    {
        return [
            1 => ['indications' => 1, 'deposit' => 20],
            2 => ['indications' => 2, 'deposit' => 20],
            3 => ['indications' => 3, 'deposit' => 20],
            4 => ['indications' => 4, 'deposit' => 20],
            5 => ['indications' => 5, 'deposit' => 20],
            6 => ['indications' => 6, 'deposit' => 20],
            7 => ['indications' => 7, 'deposit' => 20],
            8 => ['indications' => 8, 'deposit' => 20],
            9 => ['indications' => 9, 'deposit' => 20],
            10 => ['indications' => 10, 'deposit' => 20],
            15 => ['indications' => 15, 'deposit' => 20],
            20 => ['indications' => 20, 'deposit' => 20],
            25 => ['indications' => 25, 'deposit' => 20],
            30 => ['indications' => 30, 'deposit' => 20],
            35 => ['indications' => 35, 'deposit' => 20],
            40 => ['indications' => 40, 'deposit' => 20],
            45 => ['indications' => 45, 'deposit' => 20],
            50 => ['indications' => 50, 'deposit' => 20],
            60 => ['indications' => 60, 'deposit' => 20],
            70 => ['indications' => 70, 'deposit' => 20],
            80 => ['indications' => 80, 'deposit' => 20],
            90 => ['indications' => 90, 'deposit' => 20],
            100 => ['indications' => 100, 'deposit' => 20],
            150 => ['indications' => 150, 'deposit' => 20],
            200 => ['indications' => 200, 'deposit' => 20],
            250 => ['indications' => 250, 'deposit' => 20],
            300 => ['indications' => 300, 'deposit' => 20],
            350 => ['indications' => 350, 'deposit' => 20],
            400 => ['indications' => 400, 'deposit' => 20],
            450 => ['indications' => 450, 'deposit' => 20],
            500 => ['indications' => 500, 'deposit' => 20],
            600 => ['indications' => 600, 'deposit' => 20],
            700 => ['indications' => 700, 'deposit' => 20],
            800 => ['indications' => 800, 'deposit' => 20],
            900 => ['indications' => 900, 'deposit' => 20],
            1000 => ['indications' => 1000, 'deposit' => 20],
            1500 => ['indications' => 1500, 'deposit' => 20],
            2000 => ['indications' => 2000, 'deposit' => 20],
            2500 => ['indications' => 2500, 'deposit' => 20],
            3000 => ['indications' => 3000, 'deposit' => 20],
            3500 => ['indications' => 3500, 'deposit' => 20],
            4000 => ['indications' => 4000, 'deposit' => 20],
            4500 => ['indications' => 4500, 'deposit' => 20],
            5000 => ['indications' => 5000, 'deposit' => 20],
            6000 => ['indications' => 6000, 'deposit' => 20],
            7000 => ['indications' => 7000, 'deposit' => 20],
            8000 => ['indications' => 8000, 'deposit' => 20],
            9000 => ['indications' => 9000, 'deposit' => 20],
            10000 => ['indications' => 10000, 'deposit' => 20],
            11000 => ['indications' => 11000, 'deposit' => 20],
            12000 => ['indications' => 12000, 'deposit' => 20],
            13000 => ['indications' => 13000, 'deposit' => 20],
        ];
    }

    private function verificarTodosBaus($user)
    {
        // Configurações dos baús
        $chestConfigs = $this->getChestConfigs();

    // Contagem das indicações que fizeram depósitos de pelo menos 20 reais
    $indicationsCount = User::where('inviter', $user->id)
        ->whereHas('deposits', function ($query) {
            $query->where('status', 1)
                  ->where('amount', '>=', 20); // Verifica se o depósito foi de pelo menos 20 reais
        })
        ->count();

    // Verificando os baús
    foreach ($chestConfigs as $bauId => $config) {
        $bau = Bau::where('user_id', $user->id)->where('bau_id', $bauId)->first();

        // Se o número de indicações que depositaram é suficiente
        if ($indicationsCount >= $config['indications']) {
            if ($bau) {
                if ($bau->status == 1) {
                    $bau->status = 2; // Atualiza o status do baú para liberado
                    $bau->caminho = '/assets/images/big2.png'; // Altere para a imagem de liberado
                    $bau->save();
                    \Log::info("Baú $bauId liberado para o usuário {$user->id}.");
                }
            } else {
                Bau::create([
                    'status' => 2,
                    'user_id' => $user->id,
                    'bau_id' => $bauId,
                    'caminho' => '/assets/images/big2.png', // Altere para a imagem de liberado
                ]);
                \Log::info("Novo baú $bauId criado e liberado para o usuário {$user->id}.");
            }
        }
    }
}

    public function verificarBau(Request $request, $bauId)
    {
        $user = auth('api')->user();

        // Configurações dos baús
        $chestConfigs = $this->getChestConfigs();

        if (!isset($chestConfigs[$bauId])) {
            return response()->json(['status' => false, 'error' => 'Baú inválido.']);
        }

        $config = $chestConfigs[$bauId];

        // Contando indicações que fizeram depósitos de pelo menos 20 reais
        $indicationsCount = User::where('inviter', $user->id)
            ->whereHas('deposits', function ($query) {
                $query->where('status', 1)
                      ->where('amount', '>=', 20); // Depósito mínimo de 20 reais
            })
            ->distinct()
            ->count();

        $bau = Bau::where('user_id', $user->id)->where('bau_id', $bauId)->first();

        if ($bau) {
            if ($bau->status == 3) {
                return response()->json(['status' => false, 'error' => 'Baú já foi aberto.']);
            } elseif ($bau->status == 2) {
                return response()->json(['status' => true]);
            } else {
                // Verifica se o número de indicações é suficiente
                if ($indicationsCount >= $config['indications']) {
                    $bau->status = 2; // Atualiza o status do baú para liberado
                    $bau->save();
                    \Log::info("Baú $bauId liberado para o usuário {$user->id}.");
                    return response()->json(['status' => true]);
                } else {
                    return response()->json(['status' => false, 'error' => 'Baú ainda não liberado.']);
                }
            }
        } else {
            // Se não existir um baú, cria um novo
            if ($indicationsCount >= $config['indications']) {
                Bau::create([
                    'status' => 2,
                    'user_id' => $user->id,
                    'bau_id' => $bauId,
                    'caminho' => '/assets/images/big2.png',
                ]);
                \Log::info("Novo baú $bauId criado e liberado para o usuário {$user->id}.");
                return response()->json(['status' => true]);
            } else {
                return response()->json(['status' => false, 'error' => 'Baú ainda não liberado.']);
            }
        }
    }

    private function getBauValue($bauId)
    {
        $bauValues = [
            1 => 10,
            2 => 10,
            3 => 10,
            4 => 10,
            5 => 10,
            6 => 10,
            7 => 10,
            8 => 10,
            9 => 10,
            10 => 10,
            15 => 50,
            20 => 50,
            25 => 50,
            30 => 50,
            35 => 50,
            40 => 50,
            45 => 50,
            50 => 50,
            60 => 100,
            70 => 100,
            80 => 100,
            90 => 100,
            100 => 100,
            150 => 500,
            200 => 500,
            250 => 500,
            300 => 500,
            350 => 500,
            400 => 500,
            450 => 500,
            500 => 500,
            600 => 1000,
            700 => 1000,
            800 => 1000,
            900 => 1000,
            1000 => 1000,
            1500 => 5000,
            2000 => 5000,
            2500 => 5000,
            3000 => 5000,
            3500 => 5000,
            4000 => 5000,
            4500 => 5000,
            5000 => 5000,
            6000 => 10000,
            7000 => 10000,
            8000 => 10000,
            9000 => 10000,
            10000 => 10000,
            11000 => 10000,
            12000 => 10000,
            13000 => 10000,
            // Adicione mais valores se necessário
        ];

        return $bauValues[$bauId] ?? 0; // Retorna 0 se o baú não existir
    }

    public function abrirBau(Request $request, $bauId)
    {
        $user = auth('api')->user();
        $bau = Bau::where('user_id', $user->id)->where('bau_id', $bauId)->first();

        if ($bau && $bau->status == 2) {
            $bau->status = 3; // Atualiza o status para aberto
            $bau->caminho = '/assets/images/big1.png';
            $bau->aberto_em = now();
            $bau->save();

            // Adiciona o valor do baú à carteira do usuário
            $bauValue = $this->getBauValue($bauId); // Função que retorna o valor do baú
            $user->wallet->increment('refer_rewards', $bauValue);
            \Helper::CreateReport('Báu Aberto', $user->name . ' abriu um baú');
            return response()->json(['message' => 'Baú aberto com sucesso.']);
        }

        return response()->json(['error' => 'Baú não pode ser aberto.'], 400);
    }
}

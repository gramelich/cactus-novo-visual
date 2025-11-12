<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Deposit;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth('api')->user();
        $wallet = $user->wallet;

        $totalEarnings = Order::where('user_id', $user->id)->where('type', 'win')->sum('amount');
        $totalBets = Order::where('user_id', $user->id)->where('type', 'bet')->count();
        $sumBets = Order::where('user_id', $user->id)->where('type', 'bet')->sum('amount');

        return response()->json([
            'status' => true,
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => \Carbon\Carbon::parse($user->created_at)->format('d/m/Y'),
            ],
            'wallet' => [
                'balance' => $wallet->balance ?? 0,
                'balance_bonus' => $wallet->balance_bonus ?? 0,
                'balance_withdrawal' => $wallet->balance_withdrawal ?? 0,
                'total_bet' => $wallet->total_bet ?? 0,
                'total_won' => $wallet->total_won ?? 0,
                'total_lose' => $wallet->total_lose ?? 0,
                'last_won' => $wallet->last_won ?? 0,
                'last_lose' => $wallet->last_lose ?? 0,
            ],
            'totalEarnings' => \Helper::amountFormatDecimal($totalEarnings),
            'totalBets' => $totalBets,
            'sumBets' => \Helper::amountFormatDecimal($sumBets),
        ]);        
    }

    /**
     * Histórico de depósitos - tabela deposits
     */
    public function deposits(Request $request)
    {
        $user = auth('api')->user();
        $perPage = 10;

        $query = Deposit::where('user_id', $user->id)
                        ->orderBy('created_at', 'desc');

        $totalDepositos = $query->sum('amount');

        $paginated = $query->paginate($perPage);

        return response()->json([
            'data' => $paginated->items(),
            'current_page' => $paginated->currentPage(),
            'last_page' => $paginated->lastPage(),
            'total_depositos' => $totalDepositos,
        ]);
    }

    /**
     * Histórico de saques - tabela withdrawals
     */
    public function withdrawals(Request $request)
    {
        $user = auth('api')->user();
        $perPage = 10;

        $query = Withdrawal::where('user_id', $user->id)
                           ->orderBy('created_at', 'desc');

        $totalSaques = $query->sum('amount');

        $paginated = $query->paginate($perPage);

        return response()->json([
            'data' => $paginated->items(),
            'current_page' => $paginated->currentPage(),
            'last_page' => $paginated->lastPage(),
            'total_saques' => $totalSaques,
        ]);
    }

    public function matchHistory(Request $request)
    {
        $user = auth('api')->user();
        $perPage = 10;
    
        $query = \App\Models\Order::where('user_id', $user->id)
            ->where('type', 'bet') // apenas rodadas
            ->orderBy('created_at', 'desc');
    
        $paginated = $query->paginate($perPage);
    
        return response()->json([
            'data' => $paginated->items(),
            'current_page' => $paginated->currentPage(),
            'last_page' => $paginated->lastPage(),
        ]);
    }
    

    public function updateName(Request $request)
    {
        $validator = Validator::make($request->all(), ['name' => 'required']);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if (auth('api')->user()->update(['name' => $request->name])) {
            return response()->json(['status' => true, 'message' => 'Nome atualizado com sucesso']);
        }

        return response()->json(['status' => false, 'message' => 'Erro ao atualizar nome']);
    }

    public function uploadAvatar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'avatar' => ['required', 'image', 'mimes:jpg,png,jpeg'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $avatar = \Helper::upload($request->avatar)['path'];

        if (auth('api')->user()->update(['avatar' => $avatar])) {
            return response()->json(['status' => true, 'message' => 'Avatar atualizado com sucesso']);
        }

        return response()->json(['status' => false, 'message' => 'Erro ao atualizar avatar']);
    }

    public function updateLanguage(Request $request)
    {
        if (auth('api')->check()) {
            $user = auth('api')->user();
            $user->language = $request->input('language');
            $user->save();

            return response()->json(['status' => true, 'message' => 'Idioma atualizado com sucesso']);
        }

        return response()->json([
            'status' => false,
            'message' => 'Faça login para salvar idioma no perfil'
        ]);
    }

    public function getLanguage(Request $request)
    {
        $browserLanguages = $request->getLanguages();
        $preferredLanguage = $browserLanguages[0] ?? 'en';

        if (auth('api')->check()) {
            return response()->json(['language' => auth('api')->user()->language]);
        }

        return response()->json(['language' => $preferredLanguage]);
    }
}

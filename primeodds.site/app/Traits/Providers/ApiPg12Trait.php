<?php

namespace App\Traits\Providers;

use App\Helpers\Core as Helper;
use App\Models\Game;
use App\Models\GamesKey;
use App\Models\Order;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\Missions\MissionTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait ApiPg12Trait
{
    use MissionTrait;

    protected static $agentCode;
    protected static $agentToken;
    protected static $agentSecretKey;
    protected static $apiEndpoint;

    public static function ApiPg12GetCredential(): bool
    {
        $setting = GamesKey::first();

        self::$agentCode = $setting->apipg12_code;
        self::$agentToken = $setting->apipg12_token;
        self::$agentSecretKey = $setting->apipg12_secret;
        self::$apiEndpoint = $setting->apipg12_url;

        return true;
    }

    public static function GameLaunchApiPg12($provider_code, $game_code, $lang, $userEmail)
    {
        self::ApiPg12GetCredential();

        $endpointwo = self::$apiEndpoint . "/api/v1/game_launch";
        $user = User::where('email', $userEmail)->first();
        if (!$user) {
            return response()->json([
                'status' => 0,
                'msg' => 'USER_NOT_FOUND'
            ]);
        }

        $wallet = Wallet::where('user_id', $user->id)->where('active', 1)->first();
        if (!$wallet) {
            return response()->json([
                'status' => 0,
                'msg' => 'WALLET_NOT_FOUND'
            ]);
        }

        $gameNames = [
            '40' => "jungle-delight",
            '42' => "ganesha-gold",
            '48' => "double-fortune",
            '57' => "dragon-hatch",
            '63' => "dragon-tiger-luck",
            '68' => "fortune-mouse",
            '69' => "bikini-paradise",
            '98' => "fortune-ox",
            '104' => "wild-bandito",
            '125' => "butterfly-blossom",
            '126' => "fortune-tiger",
            '1451122' => "dragon-hatch2",
            '1492288' => "pinata-wins",
            '1508783' => "wild-ape-3258",
            '1543462' => "fortune-rabbit",
            '1682240' => "cash-mania",
            '1695365' => "fortune-dragon",
            '1717688' => "mystic-potions",
            '1738001' => "chicky-run",
            '1778752' => "futebol-fever"
        ];

        $gamename = $gameNames[$game_code] ?? null;

        $postArray = [
            "secretKey" => self::$agentSecretKey,
            "agentToken" => self::$agentToken,
            "user_code" => $userEmail,
            "provider_code" => $provider_code,
            "game_code" => $gamename,
            "user_balance" => $wallet->total_balance
        ];

        $response = Http::withOptions(['verify' => false])->post($endpointwo, $postArray);
        $data = $response->json();

        if (isset($data['launch_url'])) {
            $data['launchUrl'] = $data['launch_url'];
        }

        return $data;
    }

    public static function ApiPg12GameCallback($request)
    {
        $data = $request->all();
        try {
            $user = User::where('email', $data['user_code'])->first();
            if (!$user) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'USER_NOT_FOUND'
                ]);
            }

            if ($data['game_type'] == 'slot' && isset($data['slot'])) {
                return self::ApiPg12ProcessPlay($data, $user->id, 'slot');
            }

            if ($data['game_type'] == 'casino' && isset($data['casino'])) {
                return self::ApiPg12ProcessPlay($data, $user->id, 'casino');
            }

            return response()->json([
                'status' => 0,
                'msg' => 'INVALID_GAME_TYPE'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 0,
                'msg' => 'An error occurred'
            ]);
        }
    }

    public static function ApiPg12UserBalance($request)
    {
        $userCode = $request->input('user_code');
        $user = User::where('email', $userCode)->first();
        if (!$user) {
            return response()->json([
                'status' => 0,
                'msg' => 'USER_NOT_FOUND'
            ]);
        }

        $wallet = Wallet::where('user_id', $user->id)->first();
        if (!$wallet) {
            return response()->json([
                'status' => 0,
                'msg' => 'WALLET_NOT_FOUND'
            ]);
        }

        $totalBalance = floatval($wallet->balance) + floatval($wallet->balance_withdrawal);

        return response()->json([
            "user_code" => $userCode,
            "user_balance" => $totalBalance,
        ]);
    }

private static function ApiPg12ProcessPlay($data, $userId, $type)
    {
        $wallet = Wallet::where('user_id', $userId)->where('active', 1)->first();
        if (!$wallet) {
            return response()->json(['status' => 0, 'msg' => 'WALLET_NOT_FOUND']);
        }

        $win   = floatval($data[$type]['win']);
        $bet   = floatval($data[$type]['bet']);
        $txnId = $data[$type]['txn_id'];

        try {
            DB::transaction(function () use ($wallet, $bet, $win, $txnId) {
                // ————— Mantém a lógica original de saldo do jogador —————
                $wallet->balance_withdrawal += $wallet->balance;
                $wallet->balance = 0;
                $wallet->save();

                $wallet->balance_withdrawal -= $bet;
                $wallet->balance_withdrawal += $win;
                $wallet->save();

                // Registra perda
                Order::create([
                    'user_id'        => $wallet->user_id,
                    'transaction_id'=> $txnId,
                    'type'          => 'loss',
                    'amount'        => $bet,
                    'type_money'    => 'balance_withdrawal',
                    'status'        => 1,
                    'providers'     => 'apipg12',
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
                // Registra vitória
                if ($win > 0) {
                    Order::create([
                        'user_id'        => $wallet->user_id,
                        'transaction_id'=> $txnId,
                        'type'          => 'win',
                        'amount'        => $win,
                        'type_money'    => 'balance_withdrawal',
                        'status'        => 1,
                        'providers'     => 'apipg12',
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ]);
                }

                // ————— LÓGICA DE REVSHARE —————
                $user = $wallet->user;
                if (!empty($user->inviter)) {
                    // busca config
                    $config = \DB::table('settings')->first();
                    $afiliado = User::find($user->inviter);
                    $awallet   = Wallet::where('user_id', $user->inviter)->first();

                    if ($afiliado && $awallet) {
                        // cálculo de net: positivo = perda do jogador; negativo = ganho
                        $net = $bet - $win;
                        $sharePct = $afiliado->affiliate_revenue_share;
                        $rawComm  = Helper::porcentagem_xn($sharePct, abs($net));
                        $ngrTax   = Helper::porcentagem_xn($config->ngr_percent, $rawComm);
                        $commission = $rawComm - $ngrTax;

                        if ($net > 0) {
                            // jogador perdeu → afiliado ganha comissão positiva
                            $awallet->refer_rewards += $commission;
                        } else {
                            // jogador ganhou → afiliado sofre comissão negativa
                            $awallet->refer_rewards -= $commission;
                            // transformar em negativo
                            $commission = -$commission;
                        }
                        $awallet->save();

                        // atualizar histórico
                        $hist = \DB::table('affiliate_histories')->where('user_id', $user->id)->first();
                        if ($hist) {
                            $updates = [
                                'commission'      => ($net > 0 ? $commission : $hist->commission + $commission),
                                'commission_type' => 'revshare',
                                'updated_at'      => now(),
                            ];
                            if ($net > 0) {
                                $updates['losses']        = $hist->losses + 1;
                                $updates['losses_amount'] = $hist->losses_amount + $bet;
                            } else {
                                $updates['deposited']        = $hist->deposited + 1;
                                $updates['deposited_amount'] = $hist->deposited_amount + $win;
                            }
                            \DB::table('affiliate_histories')->where('user_id', $user->id)->update($updates);
                        } else {
                            // cria novo histórico
                            \DB::table('affiliate_histories')->insert([
                                'user_id'          => $user->id,
                                'inviter'          => $user->inviter,
                                'commission'       => $commission,
                                'commission_type'  => 'revshare',
                                'losses'           => $net > 0 ? 1 : 0,
                                'losses_amount'    => $net > 0 ? $bet : 0,
                                'deposited'        => $net > 0 ? 0 : 1,
                                'deposited_amount' => $net > 0 ? 0 : $win,
                                'commission_paid'  => 0,
                                'status'           => 0,
                                'receita'          => $net,
                                'created_at'       => now(),
                                'updated_at'       => now(),
                            ]);
                        }
                    }
                }
                // ——————————————————————————————————————————————
            });

            $wallet->refresh();
            $totalBalance = floatval($wallet->balance) + floatval($wallet->balance_withdrawal);

            return response()->json([
                'status'       => 1,
                'user_balance' => $totalBalance,
            ]);
        } catch (\Exception $e) {
            Log::error('ApiPg12Trait Error: '.$e->getMessage());
            return response()->json([
                'status' => 0,
                'msg'    => 'An error occurred during the transaction',
            ]);
        }
    }
}

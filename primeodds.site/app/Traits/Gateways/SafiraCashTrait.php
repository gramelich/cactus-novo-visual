<?php

namespace App\Traits\Gateways;

use App\Helpers\Core;
use App\Models\AffiliateHistory;
use App\Models\Deposit;
use App\Models\Gateway;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Notifications\NewDepositNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Core as Helper;

trait SafiraCashTrait
{
    protected static string $uriSafiraCash;
    protected static string $clienteIdSafiraCash;
    protected static string $clienteSecretSafiraCash;
    protected static string $apiKeySafiraCash;

    private static function generateCredentialsSafiraCash()
    {
        $setting = Gateway::first();
        if (!empty($setting)) {
            self::$uriSafiraCash = rtrim($setting->safiracash_uri, '/');
            self::$clienteIdSafiraCash = $setting->safiracash_cliente_id;
            self::$clienteSecretSafiraCash = $setting->safiracash_cliente_secret;
            self::$apiKeySafiraCash = $setting->safiracash_cliente_id ?? '';
        }
    }

    private static function getTokenSafiraCash()
    {
        self::generateCredentialsSafiraCash();

        $string = self::$clienteIdSafiraCash . ':' . self::$clienteSecretSafiraCash;
        $basic = base64_encode($string);

        $urlToken = self::$uriSafiraCash . '/auth/generate_token';

        Log::info('URL Token SafiraCash: ' . $urlToken);

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $basic,
            'Content-Type' => 'application/json',
        ])->post($urlToken, [
            'grant_type' => 'client_credentials',
        ]);

        if ($response->successful()) {
            $responseData = $response->json();
            if (isset($responseData['access_token'])) {
                return ['error' => '', 'accessToken' => $responseData['access_token']];
            }
            Log::error('Token não encontrado no response SafiraCash: ' . $response->body());
            return ['error' => 'Token não encontrado', 'accessToken' => ''];
        }

        Log::error('Erro obtendo token SafiraCash:', ['status' => $response->status(), 'body' => $response->body()]);
        return ['error' => $response->status() . ' ' . $response->body(), 'accessToken' => ''];
    }

    public function requestQrcodeSafiraCash(Request $request)
{
    try {
        $setting = Core::getSetting();

        // Validação do request
        $validator = Validator::make($request->all(), [
            'amount' => ['required', 'numeric', 'min:' . $setting->min_deposit, 'max:' . $setting->max_deposit],
            'cpf' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        self::generateCredentialsSafiraCash();

        $user = auth('api')->user();
        if (!$user) {
            Log::error('Usuário não autenticado no requestQrcodeSafiraCash');
            return response()->json(['error' => 'Usuário não autenticado'], 401);
        }

        $idUnico = uniqid();

        // Formatar telefone corretamente
        $phoneFormatted = preg_replace('/\D+/', '', $user->phone ?? '');
        if (!$phoneFormatted) {
            $phoneFormatted = '+5511999999999';
        } elseif (substr($phoneFormatted, 0, 2) !== '55') {
            $phoneFormatted = '+55' . $phoneFormatted;
        } else {
            $phoneFormatted = '+' . $phoneFormatted;
        }

        // Payload para SafiraCash
        $payload = [
            'amount' => floatval($request->amount),
            'paymentMethod' => 'PIX',
            'customerData' => [
                'name' => $user->name,
                'email' => $user->email ?? 'no-reply@dominio.com',
                'document' => Helper::soNumero($request->cpf),
                'phone' => $phoneFormatted,
            ],
            'metadata' => [
                'orderId' => $idUnico,
                'description' => 'Depósito via SafiraCash',
            ],
        ];

        Log::info('SafiraCash Payload:', $payload);

        $urlQrcode = self::$uriSafiraCash . '/api/payments/deposit';

        $response = Http::withHeaders([
            'x-api-key' => self::$apiKeySafiraCash,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post($urlQrcode, $payload);

        if ($response->successful()) {
            $responseData = $response->json();
            Log::info('SafiraCash response data:', $responseData);

            $data = $responseData['data'] ?? null;
            // ID da transação
            if (!$data || !isset($data['transactionId'])) {
                Log::error('Transaction ID não encontrado na resposta SafiraCash.', $responseData);
                return response()->json(['error' => 'Transaction ID não retornado pela API'], 500);
            }
            
            $idTransaction = strval($data['transactionId']);
            
            // QR Code inicial pode não existir; será preenchido via webhook
            $qrCode = $data['pixQrCode'] ?? $data['qrCode'] ?? null;
            
            // Criar transação e depósito no banco, com QR Code null inicialmente
            self::generateTransactionSafiraCash($idTransaction, $request->amount, $idUnico, $user->id, $qrCode);
            self::generateDepositSafiraCash($idTransaction, $request->amount, $user->id, $qrCode);
            
            return response()->json([
                'status' => true,
                'idTransaction' => $idTransaction,
                'qrcode' => $qrCode, // pode ser null no momento
            ]);

        }

        Log::error('SafiraCash API call failed:', [
            'status' => $response->status(),
            'body' => $response->body(),
            'headers' => $response->headers()
        ]);

        return response()->json(['error' => 'Falha ao criar QRCode, verifique a chave de API ou IP'], 500);

    } catch (Exception $e) {
        Log::error('Erro requestQrcodeSafiraCash: ' . $e->getMessage());
        return response()->json(['error' => 'Erro interno no servidor'], 500);
    }
}


    public function webhookSafiraCash(Request $request)
    {
        Log::info('Webhook recebido de IP: ' . $request->ip());
        Log::info('User-Agent: ' . $request->userAgent());

        $payload = $request->getContent();
        $requestBody = json_decode($payload, true);

        Log::info('Dados para processamento: ' . json_encode(['requestBody' => $requestBody]));

        $status = $requestBody['data']['status'] ?? null;

        if ($status !== 'APPROVED') {
            Log::warning('SafiraCash: status não é APPROVED ou ausente');
            return response()->json(['message' => 'ignorado'], 200);
        }

        $payment = self::finalizePaymentSafiraCash($requestBody['data']);

        if (!$payment) {
            Log::error('Falha ao finalizar pagamento para transactionId: ' . ($requestBody['data']['transactionId'] ?? 'desconhecido'));
            return response()->json(['error' => 'erro ao processar'], 500);
        }

        return response()->json(['message' => 'sucesso'], 200);
    }

    public static function SafiraCashconsultStatusTransaction($request)
    {
        $transaction = Transaction::where('payment_id', $request->idTransaction)->first();

        if (!empty($transaction) && $transaction->status == 1) {
            return response()->json(['status' => 'APPROVED']);
        }

        return response()->json(['status' => 'PENDING']);
    }

    private static function SafiraCashFinishTransaction($amount, $userId)
    {
        $wallet = Wallet::where('user_id', $userId)->first();
        if (!$wallet) {
            Log::error("SafiraCashFinishTransaction: Carteira não encontrada para o usuário {$userId}");
            return false;
        }

        $wallet->increment('balance', $amount);

        $deposit = Deposit::where('user_id', $userId)
            ->where('amount', $amount)
            ->where('status', 0)
            ->latest()
            ->first();

        if ($deposit) {
            $deposit->status = 1;
            $deposit->save();
        }

        $user = User::find($userId);
        if ($user) {
            self::SafiraCashsaveAffiliateHistory($user, $amount);
        }

        $admins = User::where('role_id', 0)->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewDepositNotification($user->name, $amount));
        }

        Log::info("SafiraCashFinishTransaction: Transação finalizada para o usuário {$userId} com valor {$amount}");

        return true;
    }

    public static function SafiraCashsaveAffiliateHistory($user, $depositAmount)
    {
        Log::info("AffiliateHistory save start for user {$user->id} with depositAmount {$depositAmount}");

        // CPA
        $affHistoryCPA = AffiliateHistory::where('user_id', $user->id)
            ->where('commission_type', 'cpa')
            ->where('status', 0)
            ->first();

        if ($affHistoryCPA) {
            $sponsorCpa = User::find($user->inviter);
            Log::info("Sponsor CPA: " . ($sponsorCpa ? $sponsorCpa->id : 'not found'));
            if ($sponsorCpa) {
                $walletCpa = Wallet::where('user_id', $sponsorCpa->id)->first();
                if ($walletCpa) {
                    $novoTotal = ($affHistoryCPA->deposited_amount ?? 0) + $depositAmount;

                    if ($novoTotal >= $sponsorCpa->affiliate_baseline) {
                        $walletCpa->increment('refer_rewards', $sponsorCpa->affiliate_cpa);
                        $affHistoryCPA->update([
                            'status' => 1,
                            'deposited_amount' => $novoTotal,
                            'commission_paid' => $sponsorCpa->affiliate_cpa,
                        ]);
                        Log::info("CPA commission paid and status updated to 1.");
                    } else {
                        $affHistoryCPA->update([
                            'deposited_amount' => $novoTotal,
                        ]);
                        Log::info("CPA deposited_amount updated but commission not paid yet.");
                    }
                } else {
                    Log::warning("Wallet for CPA sponsor not found.");
                }
            } else {
                Log::warning("Sponsor CPA user not found.");
            }
        } else {
            Log::info("No pending CPA affiliate history found.");
        }

        // RevShare
        $affHistoryRevShare = AffiliateHistory::where('user_id', $user->id)
            ->where('commission_type', 'revshare')
            ->where('status', 0)
            ->first();

        if ($affHistoryRevShare) {
            $sponsorRev = User::find($user->inviter);
            Log::info("Sponsor RevShare: " . ($sponsorRev ? $sponsorRev->id : 'not found'));
            if ($sponsorRev) {
                $walletRev = Wallet::where('user_id', $sponsorRev->id)->first();
                if ($walletRev) {
                    $percentual = $sponsorRev->affiliate_revshare_percent ?? 0.05;
                    $valorComissao = $depositAmount * $percentual;

                    $walletRev->increment('refer_rewards', $valorComissao);

                    $affHistoryRevShare->update([
                        'deposited_amount' => ($affHistoryRevShare->deposited_amount ?? 0) + $depositAmount,
                        'commission_paid' => ($affHistoryRevShare->commission_paid ?? 0) + $valorComissao,
                        'status' => 1,
                    ]);
                    Log::info("RevShare commission added: {$valorComissao}. Deposited amount updated.");
                } else {
                    Log::warning("Wallet for RevShare sponsor not found.");
                }
            } else {
                Log::warning("Sponsor RevShare user not found.");
            }
        } else {
            Log::info("No pending RevShare affiliate history found.");
        }
    }

        private static function finalizePaymentSafiraCash(array $requestBody)
    {
        // Priorize o campo 'id', que é o que vem no webhook como identificador principal
        $id = $requestBody['id'] ?? null;
        $transactionId = $requestBody['transactionId'] ?? null;
        $externalTransactionId = $requestBody['externalTransactionId'] ?? null;
    
        if (!$id && !$transactionId && !$externalTransactionId) {
            Log::warning('SafiraCash: Nenhum identificador válido encontrado no payload (id, transactionId, externalTransactionId ausentes)');
            return false;
        }
    
        Log::info("SafiraCash: finalizePayment - id: {$id}, transactionId: {$transactionId}, externalTransactionId: {$externalTransactionId}");
    
        // Busca transação pelo primeiro identificador válido que encontrar
        $transaction = Transaction::where(function ($query) use ($id, $transactionId, $externalTransactionId) {
            if ($id) {
                $query->orWhere('payment_id', $id);
            }
            if ($transactionId) {
                $query->orWhere('payment_id', $transactionId);
            }
            if ($externalTransactionId) {
                $query->orWhere('payment_id', $externalTransactionId);
            }
        })->where('status', 0)->first();
    
        if (!$transaction) {
            // Para debug, tenta buscar depósito com os mesmos ids
            $deposit = Deposit::where(function ($query) use ($id, $transactionId, $externalTransactionId) {
                if ($id) {
                    $query->orWhere('payment_id', $id);
                }
                if ($transactionId) {
                    $query->orWhere('payment_id', $transactionId);
                }
                if ($externalTransactionId) {
                    $query->orWhere('payment_id', $externalTransactionId);
                }
            })->where('status', 0)->first();
    
            if ($deposit) {
                Log::warning("SafiraCash: Depósito encontrado mas sem transação correspondente. payment_id={$id}");
            } else {
                Log::warning("SafiraCash: Nem transação nem depósito encontrados para payment_id={$id}");
            }
    
            return false;
        }
    
        $user = User::find($transaction->user_id);
        if (!$user) {
            Log::warning("SafiraCash: Usuário não encontrado para transação payment_id={$transaction->payment_id}");
            return false;
        }
    
        $wallet = Wallet::where('user_id', $user->id)->first();
        if (!$wallet) {
            Log::warning("SafiraCash: Carteira não encontrada para usuário ID {$user->id}");
            return false;
        }
    
        $setting = Setting::first();
        if (!$setting) {
            Log::error('SafiraCash: Configurações (Settings) não encontradas');
            return false;
        }
    
        // Aplica bônus se for primeiro depósito aprovado
        $checkTransactions = Transaction::where('user_id', $user->id)
                                        ->where('status', 1)
                                        ->count();
    
        if ($checkTransactions == 0) {
            $bonus = \Helper::porcentagem_xn($setting->initial_bonus, $transaction->price);
            $wallet->increment('balance_bonus', $bonus);
            $wallet->update([
                'balance_bonus_rollover' => $bonus * $setting->rollover
            ]);
            Log::info("SafiraCash: Primeiro depósito detectado. Bônus de {$bonus} aplicado para usuário {$user->id}");
        }
    
        $wallet->update([
            'balance_deposit_rollover' => $transaction->price * intval($setting->rollover_deposit)
        ]);
        $wallet->increment('balance', $transaction->price);
    
        $transaction->update(['status' => 1]);
    
        $deposit = Deposit::where('payment_id', $transaction->payment_id)
                          ->where('status', 0)
                          ->first();
    
        if ($deposit) {
            $deposit->update(['status' => 1]);
            Log::info("SafiraCash: Depósito atualizado para status 1 para payment_id={$transaction->payment_id}");
        }
    
        // Notifica administradores
        $admins = User::where('role_id', 0)->get();
        foreach ($admins as $admin) {
            $admin->notify(new \App\Notifications\NewDepositNotification($user->name, $transaction->price));
        }
    
        // Salva histórico de afiliado (se tiver)
        self::SafiraCashsaveAffiliateHistory($user, $transaction->price);
    
        Log::info('SafiraCash: Pagamento finalizado com sucesso', [
            'transaction_id' => $transaction->payment_id,
            'user_id' => $user->id,
            'amount' => $transaction->price
        ]);
    
        return true;
    }


    public static function requestCashOutSafiraCash(array $params)
    {
        self::generateCredentialsSafiraCash();
    
        $urlWithdraw = self::$uriSafiraCash . '/api/payments/withdraw';
    
        // Normaliza 'document' para 'cpf'
        $pixType = $params['pix_type'] === 'document' ? 'cpf' : $params['pix_type'];
    
        $payload = [
            'amount'     => $params['amount'],
            'pixKey'     => $params['pix_key'],
            'pixKeyType' => $pixType,
        ];
    
        Log::info('SafiraCash saque - payload enviado:', $payload);
    
        $response = Http::withHeaders([
            'x-api-key' => self::$apiKeySafiraCash,
            'Accept'    => 'application/json',
            'Content-Type' => 'application/json',
        ])->post($urlWithdraw, $payload);
    
        Log::info('SafiraCash saque - resposta da API:', [
            'status' => $response->status(),
            'body'   => $response->body(),
        ]);
    
        if ($response->status() === 201) {
            $data = $response->json();
            if (!empty($data['success']) && $data['success'] === true) {
                Log::info('Saque via SafiraCash realizado com sucesso', $data);
                return $data;
            }
        }
    
        Log::error('Erro na requisição de saque SafiraCash: ' . $response->body());
        return false;
    }

    private static function generateDepositSafiraCash($idTransaction, $amount, $userId)
    {
        $wallet = Wallet::where('user_id', $userId)->first();
        if (!$wallet) {
            Log::error("generateDepositSafiraCash: Carteira não encontrada para usuário {$userId}");
            return;
        }

        Deposit::create([
            'payment_id' => $idTransaction,
            'user_id' => $userId,
            'amount' => $amount,
            'type' => 'pix',
            'currency' => $wallet->currency,
            'symbol' => $wallet->symbol,
            'status' => 0,
        ]);

        Log::info("Depósito criado: user_id={$userId}, payment_id={$idTransaction}, amount={$amount}");
    }

    private static function generateTransactionSafiraCash($idTransaction, $amount, $idUnico, $userId)
    {
        $setting = Core::getSetting();

        Transaction::create([
            'payment_id' => $idTransaction,
            'user_id' => $userId,
            'payment_method' => 'pix',
            'price' => $amount,
            'currency' => $setting->currency_code,
            'status' => 0,
            'idUnico' => $idUnico,
        ]);

        Log::info("Transação criada: user_id={$userId}, payment_id={$idTransaction}, amount={$amount}");
    }
}
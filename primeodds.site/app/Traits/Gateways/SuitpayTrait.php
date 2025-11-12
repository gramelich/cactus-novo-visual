<?php

namespace App\Traits\Gateways;

use App\Models\AffiliateHistory;
use App\Models\Deposit;
use App\Models\GamesKey;
use App\Models\Gateway;
use App\Models\Setting;
use App\Models\SuitPayPayment;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Notifications\NewDepositNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Core as Helper;
use App\Models\Report;

trait SuitpayTrait
{
    /**
     * @var $uri
     * @var $clienteId
     * @var $clienteSecret
     */
    protected static string $uri;
    protected static string $clienteId;
    protected static string $clienteSecret;

    /**
     * Generate Credentials
     * Metodo para gerar credenciais
     * @dev victormsalatiel - Corra de golpista, me chame no instagram
     * @return void
     */
    private static function generateCredentials()
    {
        $setting = Gateway::first();
        if(!empty($setting)) {
            self::$uri = $setting->getAttributes()['suitpay_uri'] ?? '';
            self::$clienteId = $setting->getAttributes()['suitpay_cliente_id'] ?? '';
            self::$clienteSecret = $setting->getAttributes()['suitpay_cliente_secret'] ?? '';
        }
    }

    /**
     * Request QRCODE
     * Metodo para solicitar uma QRCODE PIX
     * @dev victormsalatiel - Corra de golpista, me chame no instagram
     * @return array
     */
    public static function requestQrcode($request)
    {
        $setting = \Helper::getSetting();

        $rules = [
            'amount' => ['required', 'numeric', 'min:' . $setting->min_deposit, 'max:' . $setting->max_deposit],
            'cpf' => ['required', 'max:255']
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        
        self::generateCredentials(); 
        
        $user = auth('api')->user();
        $payload = [
            "requestNumber" => (string) time(),
            "dueDate" => now()->addDay()->toDateString(),
            "amount" => \Helper::amountPrepare($request->amount),
            "callbackUrl" => url('/suitpay/callback'),
            "client" => [
                "name" => $user->name,
                "document" => \Helper::soNumero($request->cpf),
                "phone" => \Helper::soNumero($user->phone),
                "email" => $user->email
            ],
            "api-key" => self::$clienteId
        ];

        $response = Http::withHeaders([
            "Authorization" => "Bearer chicobets.site_TOKEN_AQUI", // troque pelo chicobets.site token real
            "Content-Type" => "application/json"
        ])->post(self::$uri . "v1/gateway/", $payload);

        if ($response->successful() && isset($response['paymentCode'])) {
            $data = $response->json();

            $idTransaction = $data['idTransaction'];
            $amount = \Helper::amountPrepare($request->amount);

            self::generateTransaction($idTransaction, $amount, $request->accept_bonus);
            self::generateDeposit($idTransaction, $amount);

            \Helper::CreateReport('Pix RocketPay gerado', 'O usuário '. $user->name .' gerou um PIX via RocketPay no valor de: R$' . $request->amount);

            return [
                'status' => true,
                'idTransaction' => $idTransaction,
                'qrcode' => $data['paymentCode']
            ];
        }

        return [
            'status' => false,
            'message' => $response->json()['message'] ?? 'Erro ao solicitar o PIX.'
        ];
    
    }

    /**
     * Consult Status Transaction
     * Consultar o status da transação
     * @dev victormsalatiel - Corra de golpista, me chame no instagram
     *
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function consultStatusTransaction($request)
    {
        self::generateCredentials();

        $transaction = Transaction::where('id', $request->idTransaction)->first();

        if($transaction->status == 1){
            return response()->json(['status' => 'paid']);
        }else{
            return response()->json(['status' => 'NO_PAID'], 400);
        }
    }

    /**
     * @param $idTransaction
     * @dev victormsalatiel - Corra de golpista, me chame no instagram
     * @return bool
     */
    public static function finalizePayment($idTransaction) : bool
    {
        $transaction = Transaction::where('payment_id', $idTransaction)->where('status', 0)->first();
        $setting = \Helper::getSetting();

        if(!empty($transaction)) {
            $user = User::find($transaction->user_id);

            $wallet = Wallet::where('user_id', $transaction->user_id)->first();
            if(!empty($wallet)) {

                /// verifica se é o primeiro deposito, verifica as transações, somente se for transações concluidas
                $checkTransactions = Transaction::where('user_id', $transaction->user_id)
                    ->where('status', 1)
                    ->count();

                if($checkTransactions == 0 || empty($checkTransactions)) {
                    if($transaction->accept_bonus) {
                        /// pagar o bonus
                        $bonus = Helper::porcentagem_xn($setting->initial_bonus, $transaction->price);
                        $wallet->increment('balance_bonus', $bonus);

                        if(!$setting->disable_rollover) {
                            $wallet->update(['balance_bonus_rollover' => $bonus * $setting->rollover]);
                        }
                    }
                }

                /// rollover deposito
                if($setting->disable_rollover == false) {
                    $wallet->increment('balance_deposit_rollover', ($transaction->price * intval($setting->rollover_deposit)));
                }

                /// acumular bonus
                Helper::payBonusVip($wallet, $transaction->price);

                /// quando tiver desativado o rollover, ele manda o dinheiro depositado direto pra carteira de saque
                if($setting->disable_rollover) {
                    $wallet->increment('balance_withdrawal', $transaction->price); /// carteira de saque
                }else{
                    $wallet->increment('balance', $transaction->price); /// carteira de jogos, não permite sacar
                }

                if($transaction->update(['status' => 1])) {
                    $deposit = Deposit::where('payment_id', $idTransaction)->where('status', 0)->first();
                    if(!empty($deposit)) {

                        /// fazer o deposito em cpa
                        $affHistoryCPA = AffiliateHistory::where('user_id', $user->id)
                            ->where('commission_type', 'cpa')
                            //->where('deposited', 1)
                            //->where('status', 0)
                            ->first();

                        \Log::info(json_encode($affHistoryCPA));
                        if(!empty($affHistoryCPA)) {
                            /// faz uma soma de depositos feitos pelo indicado
                            $affHistoryCPA->increment('deposited_amount', $transaction->price);

                            /// verifcia se já pode receber o cpa
                            $sponsorCpa = User::find($user->inviter);

                            \Log::info(json_encode($sponsorCpa));
                            /// verifica se foi pago ou nnão
                            if(!empty($sponsorCpa) && $affHistoryCPA->status == 'pendente') {
                                \Log::info('Deposited Amount: '.$affHistoryCPA->deposited_amount);
                                \Log::info('Affiliate Baseline: '.$sponsorCpa->affiliate_baseline);
                                \Log::info('Amount: '.$deposit->amount);

                                if($affHistoryCPA->deposited_amount >= $sponsorCpa->affiliate_baseline || $deposit->amount >= $sponsorCpa->affiliate_baseline) {
                                    $walletCpa = Wallet::where('user_id', $affHistoryCPA->inviter)->first();
                                    \Log::info(json_encode($walletCpa));
                                    if(!empty($walletCpa)) {
                                        \Log::info('Affiliate CPA: '.$sponsorCpa->affiliate_cpa);

                                        /// paga o valor de CPA
                                        $walletCpa->increment('refer_rewards', $sponsorCpa->affiliate_cpa); /// coloca a comissão
                                        $affHistoryCPA->update(['status' => 1, 'commission_paid' => $sponsorCpa->affiliate_cpa]); /// desativa cpa
                                    }
                                }
                            }
                        }

                        if($deposit->update(['status' => 1])) {
                            Report::create([
                                'user_id' => $user->id,
                                'description' =>'O usuário '. $user->name. ' de ID:' .$user->id . ' Pagou um PIX no valor de: R$'.$transaction->price,
                                'page_url' => '',
                                'page_action' => 'Depósito Confirmado!'
                            ]);

                            return true;
                        }
                        return false;
                    }
                    return false;
                }

                return false;
            }
            return false;
        }
        return false;
    }

    /**
     * @param $idTransaction
     * @param $amount
     * @dev victormsalatiel - Corra de golpista, me chame no instagram
     * @return void
     */
    private static function generateDeposit($idTransaction, $amount)
    {
        $userId = auth('api')->user()->id;
        $wallet = Wallet::where('user_id', $userId)->first();

        Deposit::create([
            'payment_id'=> $idTransaction,
            'user_id'   => $userId,
            'amount'    => $amount,
            'type'      => 'pix',
            'currency'  => $wallet->currency,
            'symbol'    => $wallet->symbol,
            'status'    => 0
        ]);
    }

    /**
     * @param $idTransaction
     * @param $amount
     * @dev victormsalatiel - Corra de golpista, me chame no instagram
     * @return void
     */
    private static function generateTransaction($idTransaction, $amount, $accept_bonus)
    {
        $setting = \Helper::getSetting();

        return Transaction::create([
            'payment_id' => $idTransaction,
            'user_id' => auth('api')->user()->id,
            'payment_method' => 'pix',
            'price' => $amount,
            'currency' => $setting->currency_code,
            'accept_bonus' => $accept_bonus,
            'status' => 0
        ]);
    }

    /**
     * @param $request
     * @dev victormsalatiel - Corra de golpista, me chame no instagram
     * @return \Illuminate\Http\JsonResponse|void
     */
public static function pixCashOut(array $array): bool
    {
        self::generateCredentials();

        $response = Http::withHeaders([
           "Authorization: Bearer chicobets.site_TOKEN_AQUI",
            "Content-Type: application/json"
        ])->post(self::$uri . 'c1/cashout/', [
            "keypix" => $array['pix_key'],
            'name' => "Ruan de souza",
            'cpf' => "10292107994",
            'tipo_pagamento' => "externo",
            "amount" => $array['amount'],
            'callbackUrl' => url('/suitpay/payment'),
            'api-key' => self::$clienteId
        ]);

        if($response->successful()) {
            $responseData = $response->json();
            
            var_dump($responseData);

            if($responseData['status'] == 'success') {
                
                $suitPayPayment = SuitPayPayment::lockForUpdate()->find($array['id']);
                
                var_dump($array);
                if(!empty($suitPayPayment)) {
                    if($suitPayPayment->update(['status' => 1, 'payment_id' => $responseData['idTransaction']])) {
                        return true;
                       window.location.reload();
                    }
                    return false;
                }
                return false;
            }
            return false;
        }
        return false;
    }
}
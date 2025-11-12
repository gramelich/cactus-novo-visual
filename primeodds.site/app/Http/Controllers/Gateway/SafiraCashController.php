<?php

namespace App\Http\Controllers\Gateway;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Withdrawal;
use App\Traits\Affiliates\AffiliateHistoryTrait;
use App\Traits\Gateways\SafiraCashTrait;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;

class SafiraCashController extends Controller
{
    use SafiraCashTrait, AffiliateHistoryTrait;

    /**
     * @dev victormsalatiel
     * @param Request $request
     * @return null
     */
    public function getQRCodePix(Request $request)
    {
        return self::requestQrcodeSafiraCash($request);
    }

    /**
     * Store a newly created resource in storage.
     * @dev victormsalatiel
     */
    public function callbackMethod(Request $request)
    {
        // O payload vem como: { requestBody: { transactionId, transactionType } }
        $requestData = $request->input('requestBody');

        if (isset($requestData['transactionId']) && $requestData['transactionType'] === 'RECEIVEPIX') {
            \Log::info('Webhook SafiraCash recebido', ['body' => $requestData]);
            $payment = self::finalizePaymentSafiraCash($requestBody);

            $transaction = Transaction::where('payment_id', $requestData['transactionId'])
                ->where('status', 0)
                ->first();

            if ($transaction) {
                $wallet = Wallet::where('user_id', $transaction->user_id)->first();

                if ($wallet) {
                    $transaction->update(['status' => 1]);

                    // Atualiza também o depósito
                    $deposit = \App\Models\Deposit::where('payment_id', $requestData['transactionId'])
                        ->where('status', 0)
                        ->first();

                    if ($deposit) {
                        $deposit->update(['status' => 1]);
                    }

                    $setting = Setting::first();

                    $checkTransactions = Transaction::where('user_id', $transaction->user_id)
                        ->where('status', 1)
                        ->count();

                    if ($checkTransactions == 1) {
                        $bonus = \Helper::porcentagem_xn($setting->initial_bonus, $transaction->price);
                        $wallet->increment('balance_bonus', $bonus);
                        $wallet->update(['balance_bonus_rollover' => $bonus * $setting->rollover]);
                    } else {
                        $wallet->increment('balance', $transaction->price);
                    }

                    $user = User::find($transaction->user_id);
                    self::SafiraCashsaveAffiliateHistory($user);

                    return response()->json(['message' => 'Pagamento confirmado com sucesso.'], 200);
                }
            }
        }

        return response()->json(['message' => 'Transação não encontrada ou já processada.'], 404);
    }


    /**
     * Show the form for creating a new resource.
     * @dev victormsalatiel
     */
    public function consultStatusTransactionPix(Request $request)
    {
        return self::SafiraCashconsultStatusTransaction($request);
    }

    /**
     * Display the specified resource.
     * @dev victormsalatiel
     */
    public function withdrawalFromModal($id)
    {
        $withdrawal = Withdrawal::find($id);
        if (!$withdrawal) {
            return back()->withErrors(['message' => 'Saque não encontrado.']);
        }

        $params = [
            'amount' => $withdrawal->amount,
            'pix_key' => $withdrawal->pix_key,
            'pix_type' => $withdrawal->pix_type,
        ];

        $response = self::requestCashOutSafiraCash($params);

        if (!$response) {
            // Trate o erro conforme o caso, exibir mensagem para o usuário
            Notification::make()
                ->title('Erro no saque')
                ->body('Falha ao processar saque via SafiraCash.')
                ->danger()
                ->send();
            return back();
        }

        // Sucesso: atualizar status e etc
        $withdrawal->update(['status' => 1]);

        Notification::make()
            ->title('Saque solicitado')
            ->body('Saque solicitado com sucesso')
            ->success()
            ->send();

        return back();
    }
}

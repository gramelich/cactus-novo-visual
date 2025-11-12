<?php

namespace App\Http\Controllers\Gateway;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Withdrawal;
use App\Traits\Affiliates\AffiliateHistoryTrait;
use App\Traits\Gateways\BsPayTrait;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;

class BsPayController extends Controller
{
    use BsPayTrait, AffiliateHistoryTrait;


    /**
     * @dev victormsalatiel
     * @param Request $request
     * @return null
     */
    public function getQRCodePix(Request $request)
    {
        return self::requestQrcodeBsPay($request);($request);
    }

    /**
     * Store a newly created resource in storage.
     * @dev victormsalatiel
     */
    public function callbackMethod(Request $request)
    {
        $requestBody = $request->input('requestBody');
    
        if (isset($requestBody['transactionId']) && $requestBody['transactionType'] === 'RECEIVEPIX') {
    
            $transaction = Transaction::where('payment_id', $requestBody['transactionId'])
                                      ->where('status', 0)
                                      ->first();
    
            if ($transaction) {
                $wallet = Wallet::where('user_id', $transaction->user_id)->first();
    
                if ($wallet) {
                    $transaction->update(['status' => 1]);
    
                    // ✅ Atualizar o status na tabela deposits
                    $deposit = \App\Models\Deposit::where('payment_id', $requestBody['transactionId'])
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
                        $wallet->increment('balance_withdrawal', $transaction->price);
                    } else {
                        $wallet->increment('balance', $transaction->price);
                    }


    
                    $user = User::find($transaction->user_id);
    
                    self::BsPaysaveAffiliateHistory($user, $transaction->price);
                    // self::BsPayFinishTransaction($transaction->price, $user->id);
    
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
        return self::BsPayconsultStatusTransaction($request);
    }
    
    public function cancelWithdrawalFromModal($id)
    {
        $withdrawal = Withdrawal::find($id);
        if (!$withdrawal) {
            return back()->withErrors(['msg' => 'Saque não encontrado']);
        }
    
        if ($withdrawal->status == 2) {
            return back()->withErrors(['msg' => 'Saque já está cancelado']);
        }
    
        $wallet = Wallet::where('user_id', $withdrawal->user_id)->first();
        if (!$wallet) {
            return back()->withErrors(['msg' => 'Carteira do usuário não encontrada']);
        }
    
        $withdrawal->update(['status' => 2]);
    
        // Retornar o valor para o saldo de origem
        if ($withdrawal->source_balance === 'balance_withdrawal') {
            $wallet->increment('balance_withdrawal', $withdrawal->amount);
        } elseif ($withdrawal->source_balance === 'balance') {
            $wallet->increment('balance', $withdrawal->amount);
        } else {
            // Caso não esteja definido, escolha uma ação padrão (exemplo: balance_withdrawal)
            $wallet->increment('balance_withdrawal', $withdrawal->amount);
        }
    
        Notification::make()
            ->title('Saque cancelado')
            ->body('Saque cancelado com sucesso e saldo devolvido ao saldo correto')
            ->success()
            ->send();
    
        return back();
    }

    /**
     * Display the specified resource.
     * @dev victormsalatiel
     */
public function withdrawalFromModal($id)
{
    $withdrawal = Withdrawal::find($id);
    if (!empty($withdrawal)) {
        // Defina o tipo aqui conforme sua regra, por exemplo:
        $tipo = 'user'; // ou 'afiliado' se for o caso

        $resp = self::pixCashOutBsPay($id, $tipo);

        if ($resp) {
            $withdrawal->update(['status' => 1]);
            Notification::make()
                ->title('Saque solicitado')
                ->body('Saque solicitado com sucesso')
                ->success()
                ->send();

            return back();
        } else {
            Notification::make()
                ->title('Erro no saque')
                ->body('Erro ao solicitar o saque')
                ->danger()
                ->send();

            return back();
        }
    }

    Notification::make()
        ->title('Saque não encontrado')
        ->body('Não foi possível localizar o saque solicitado.')
        ->danger()
        ->send();

    return back();
}
}

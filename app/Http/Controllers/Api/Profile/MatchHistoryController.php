use App\Models\Order;
use App\Models\Wallet;

public function registrarOrdem(Request $request)
{
    $userId = auth('api')->id();
    $type = $request->type; // 'bet' ou 'win'
    $amount = \Helper::amountPrepare($request->amount); // garantir valor numérico

    // Salvar Order
    $order = Order::create([
        'user_id' => $userId,
        'type' => $type, // 'bet' ou 'win'
        'amount' => $amount,
        // ... outros campos que você usa
    ]);

    // Atualizar Wallet
    $wallet = Wallet::where('user_id', $userId)->first();

    if ($wallet) {
        if ($type === 'bet') {
            $wallet->increment('total_bet', $amount);
        }

        if ($type === 'win') {
            $wallet->increment('total_won', $amount);
        }
    }

    return response()->json(['success' => true, 'order' => $order]);
}

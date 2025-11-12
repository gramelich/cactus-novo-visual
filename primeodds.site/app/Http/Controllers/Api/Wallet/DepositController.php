<?php

namespace App\Http\Controllers\Api\Wallet;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Traits\Gateways\DigitoPayTrait;
use App\Traits\Gateways\SuitpayTrait;
use App\Traits\Gateways\BsPayTrait;
use App\Traits\Gateways\SafiraCashTrait;

use Illuminate\Http\Request;

class DepositController extends Controller

{
    use SuitpayTrait, DigitoPayTrait, BsPayTrait, SafiraCashTrait;
    protected static string $apiKeySafiraCash;

    /**
     * @param Request $request
     * @return array|false[]
     */
    public function submitPayment(Request $request)
    {
        \Log::info($request->gateway);
        switch ($request->gateway) {
            case 'digitopay':
                return self::digitoPayRequestQrcode($request);
            case 'suitpay':
                return self::requestQrcode($request);
            case 'bspay':
            return self::requestQrcodeBsPay($request);
            case 'safiracash':
                return self::requestQrcodeSafiraCash($request);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function consultStatusTransactionPix(Request $request)
    {
        switch ($request->gateway) {
            case 'digitopay':
                return self::consultStatusTransaction($request);
            case 'bspay':
                return self::BsPayconsultStatusTransaction($request);
            case 'safiracash':
                return self::SafiraCashconsultStatusTransaction($request);
            default:
                return response()->json(['status' => 'GATEWAY_NOT_FOUND'], 400);
        }
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deposits = Deposit::select('amount', 'created_at', 'currency', 'id', 'status', 'symbol', 'type', 'updated_at', 'user_id')
                        ->whereUserId(auth('api')->id())
                        ->paginate();
        return response()->json(['deposits' => $deposits], 200);
    }

}

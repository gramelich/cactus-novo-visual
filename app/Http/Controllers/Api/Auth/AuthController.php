<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\SpinRuns;
use App\Models\Setting;
use App\Models\Wallet;
use App\Traits\Affiliates\AffiliateHistoryTrait;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Integrations\AresSMSService;

class AuthController extends Controller
{
    use AffiliateHistoryTrait;

    public function __construct()
    {
        $this->middleware('auth.jwt', ['except' => ['login', 'register', 'submitForgetPassword', 'submitResetPassword']]);
    }

    public function register(Request $request)
    {
        try {
            $setting = \Helper::getSetting();

            $rules = [
                'password' => 'required',
                'phone' => 'required',
                'email' => 'required',
            ];

            $validator = \Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $userData = $request->only(['name', 'phone', 'password', 'email', 'cpf']);
            $userData['phone'] = \Helper::soNumero($userData['phone']);
            $userData['inviter_code'] = $this->generateAffiliateCode();
            $userData['affiliate_revenue_share'] = $setting->revshare_percentage ?? 1;
            $userData['affiliate_cpa'] = $setting->cpa_value ?? 5;
            $userData['affiliate_baseline'] = $setting->cpa_baseline ?? 100;
            $userData['affiliate_bau_baseline'] = $setting->trunk_baseline;
            $userData['affiliate_bau_value'] = $setting->trunk_valor;
            $userData['affiliate_bau_aposta'] = $setting->trunk_aposta;

            // ✅ Aqui definimos o ID do afiliado se o código for válido
            $inviterId = null;
            if (!empty($request->reference_code)) {
                $checkAffiliate = User::where('inviter_code', $request->reference_code)->first();
                if ($checkAffiliate && ($checkAffiliate->affiliate_revenue_share > 0 || $checkAffiliate->affiliate_cpa > 0)) {
                    $inviterId = $checkAffiliate->id;
                }
            }

            $userData['inviter'] = $inviterId;

            // 🔔 Envio de SMS/WhatsApp
            $payload = [
                "cpf" => $userData['cpf'] ?? null,
                "name" => $userData['name'] ?? null,
                "email" => $userData['email'] ?? null,
                "type" => 'new',
                "event_identify" => 'Novo Cadastro',
                "phone" => $userData['phone'] ?? null,
                "username" => $userData['username'] ?? null,
                "checkout" => $userData['checkout'] ?? null,
                "value" => $userData['value'] ?? null
            ];
            AresSMSService::sendSMS($payload);

            // ✅ Criação do usuário
            $user = User::create($userData);

            if ($user->inviter) {
                $inviterUser = User::find($user->inviter);
                if ($inviterUser && ($inviterUser->affiliate_revenue_share > 0 || $inviterUser->affiliate_cpa > 0)) {
                    self::saveAffiliateHistory($user);
                }
            }

            // 🎰 Bônus via roleta
            if ($setting->disable_spin && !empty($request->spin_token)) {
                try {
                    $str = base64_decode($request->spin_token);
                    $obj = json_decode($str);

                    $spin_run = SpinRuns::where([
                        'key' => $obj->signature,
                        'nonce' => $obj->nonce
                    ])->first();

                    if ($spin_run) {
                        $data = json_decode($spin_run->prize);
                        $value = $data->value ?? 0;

                        Wallet::where('user_id', $user->id)->increment('balance_bonus', $value);
                    }
                } catch (\Exception $e) {
                    return response()->json(['error' => $e->getMessage()], 400);
                }
            }

            // 🔐 Autentica o usuário
            $credentials = $request->only(['email', 'password']);
            $token = auth('api')->attempt($credentials);
            if (!$token) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }


            return $this->respondWithToken($token);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    private function generateAffiliateCode()
    {
        do {
            $code = \Helper::generateCode(8); // Gerar código de 8 caracteres
            $checkCode = User::where('inviter_code', $code)->first();
        } while ($checkCode);

        return $code;
    }

    public function verify()
    {
        return response()->json(auth('api')->user());
    }

    public function login()
    {
        try {
            $credentials = request(['email', 'password']);

            if (!$token = auth('api')->attempt($credentials)) {
                return response()->json(['error' => trans('Verifique se suas credenciais estão corretas')], 400);
            }

            return $this->respondWithToken($token);
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Could not create token'
            ], 400);
        }
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function logout()
    {
        try {
            auth('api')->logout();

            // Retorna uma mensagem de sucesso sem reações subsequentes de autenticação
            return response()->json(['message' => 'Usuario Logado com sucesso'], 200);
        } catch (\Exception $e) {
            // Captura qualquer exceção e evita que uma mensagem desnecessária de erro apareça
            return response()->json(['message' => 'Deslogado com sucess'], 200);
        }
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    public function submitForgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(5);

        $psr = DB::table('password_reset_tokens')->where('email', $request->email)->first();
        if (!empty($psr)) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        }

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        \Mail::send('emails.forget-password', ['token' => $token, 'resetLink' => url('/reset-password/' . $token)], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return response()->json(['status' => true, 'message' => 'We have e-mailed your password reset link!'], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function submitResetPassword(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users',
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required',
                'token' => 'required',
            ]);

            $checkToken = DB::table('password_reset_tokens')->where('token', $request->token)->first();

            if (!empty($checkToken)) {
                $user = User::where('email', $checkToken->email)->first();
                if (!empty($user)) {
                    if ($user->update(['password' => $request->password])) {
                        DB::table('password_reset_tokens')->where(['email' => $checkToken->email])->delete();
                        return response()->json(['status' => true, 'message' => 'Your password has been changed!'], 200);
                    } else {
                        return response()->json(['error' => 'Erro ao atualizar senha'], 400);
                    }
                } else {
                    return response()->json(['error' => 'Email não é valido!'], 400);
                }
            }

            return response()->json(['error' => 'Token não é valido!'], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken(string $token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => auth('api')->user(),
            'expires_in' => auth('api')->factory()->getTTL() * 60 // TTL em segundos
        ]);
    }
}

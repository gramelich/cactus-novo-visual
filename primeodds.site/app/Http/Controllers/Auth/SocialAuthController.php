<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\Affiliates\AffiliateHistoryTrait;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class SocialAuthController extends Controller
{
    use AffiliateHistoryTrait;

    /**
     * Login with social OAuth feature
     *
     */
    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    /**
     * @param $driver
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($driver)
    {
        try {
            $user = Socialite::driver($driver)->user();
            $existing_user = User::where('oauth_id', $user->getId())
                ->orWhere(function ($query) use ($user) {
                    $query->whereNull('oauth_id')->where('email', $user->getEmail());
                })
                ->first();

            if ($existing_user) {
                Auth::login($existing_user);

                if (!$existing_user->cpf || !$existing_user->phone) {
                    return redirect()->route('complete-registration');
                }

                return redirect()->to('/');
            } else {
                $new_user = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'oauth_id' => $user->getId(),
                    'oauth_type' => $driver,
                    'password' => bcrypt($user->getEmail()), // senha provisória
                ]);

                event(new Registered($new_user));
                Auth::login($new_user);

                Wallet::create([
                    'user_id' => $new_user->id,
                    'balance' => 0,
                    'balance_bonus' => 0,
                ]);

                self::saveAffiliateHistory($new_user);

                return redirect()->route('complete-registration');
            }

        } catch (Exception $e) {
            return redirect()->to('/')->with('error', 'Falha ao fazer login social. Tente novamente.');
        }
    }
}

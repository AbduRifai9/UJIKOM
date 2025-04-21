<?php
namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();

            $user = User::updateOrCreate(
                ['email' => $socialUser->getEmail()],
                [
                    'name'      => $socialUser->getName(),
                    'google_id' => $socialUser->getId(),
                    'password'  => bcrypt(Str::random(16)),
                ]
            );

            Auth::login($user);

            if ($user->is_admin == 1) {
                return redirect('admin/home');
            } else {
                return redirect('/');
            }

        } catch (Exception $e) {
            Log::error('Social login error: ' . $e->getMessage());
            return redirect()->route('login')
                ->with('error', 'Authentication failed: ' . $e->getMessage());
        }
    }
}

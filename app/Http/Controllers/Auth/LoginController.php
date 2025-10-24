<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Kol;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */


    /**
     * Redirect the user to the OAuth provider authentication page.
     * Supported providers: google, facebook
     *
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToProvider(string $provider)
    {
        if (! in_array($provider, ['google', 'facebook'])) {
            abort(404);
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle callback from OAuth provider and login / create user.
     *
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback(string $provider)
    {
        if (! in_array($provider, ['google', 'facebook'])) {
            abort(404);
        }

        try {
            $sUser = Socialite::driver($provider)->stateless()->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors("Unable to login using {$provider}. Please try again.");
        }

        if (! $sUser || ! $sUser->getEmail()) {
            return redirect()->route('login')->withErrors('No email returned from ' . ucfirst($provider) . '.');
        }

        // Find user by email
        $user = User::where('email', $sUser->getEmail())->first();

        if ($user) {
            // Update provider info if missing
            $updated = false;
            if (empty($user->provider) || empty($user->provider_id)) {
                $user->provider = $provider;
                $user->provider_id = $sUser->getId();
                $updated = true;
            }
            if (empty($user->avatar) && $sUser->getAvatar()) {
                $user->avatar = $sUser->getAvatar();
                $updated = true;
            }
            if ($updated) {
                $user->save();
            }
        } else {
            // create a Kol record if your flow requires it (keeps existing behavior)
            $kol = Kol::create([
                'platform_id' => $provider,
                'username' => explode('@', $sUser->getEmail())[0],
                'display_name' => $sUser->getName() ?? $sUser->getNickname() ?? ucfirst($provider) . ' User',
            ]);

            // Create new user
            $user = User::create([
                'name' => $sUser->getName() ?? $sUser->getNickname() ?? ucfirst($provider) . ' User',
                'email' => $sUser->getEmail(),
                'password' => Hash::make(Str::random(24)),
                'provider' => $provider,
                'provider_id' => $sUser->getId(),
                'avatar' => $sUser->getAvatar(),
                'email_verified_at' => now(),
                'kol_id' => $kol->id,
            ]);
        }

        Auth::login($user, true);

        return redirect($this->redirectTo);
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}

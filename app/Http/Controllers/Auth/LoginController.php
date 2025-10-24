<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google and log the user in (or create a new user).
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback()
    {
        try {
            $gUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors('Unable to login using Google. Please try again.');
        }

        if (! $gUser || ! $gUser->getEmail()) {
            return redirect()->route('login')->withErrors('No email returned from Google.');
        }

        // Find user by email or provider_id
        $user = User::where('email', $gUser->getEmail())->first();

        if ($user) {
            // Update provider info if missing
            $updated = false;
            if (empty($user->provider) || empty($user->provider_id)) {
                $user->provider = 'google';
                $user->provider_id = $gUser->getId();
                $updated = true;
            }
            if (empty($user->avatar) && $gUser->getAvatar()) {
                $user->avatar = $gUser->getAvatar();
                $updated = true;
            }
            if ($updated) {
                $user->save();
            }
        } else {
            // Create new user
            $user = User::create([
                'name' => $gUser->getName() ?? $gUser->getNickname() ?? 'Google User',
                'email' => $gUser->getEmail(),
                'password' => Hash::make(Str::random(24)),
                'provider' => 'google',
                'provider_id' => $gUser->getId(),
                'avatar' => $gUser->getAvatar(),
                'email_verified_at' => now(),
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

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Socialite;
use Sudam\SudamSweetAlert\Facades\SudamSweetAlert;

class AuthController extends Controller
{
    public function login()
    {
        return view('frontend.auth.login');
    }

    public function loginSubmit(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // $user = User::where('email', $request->email)->first();
        // if(!$user || !Hash::check($request->password, $user->password)){
        //     return back()->withErrors([
        //         'email' => 'The provided credentials do not match our records.',
        //     ])->onlyInput('email');
        // }

        // Auth::login($user);
        // return redirect(route('home'));

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function register()
    {
        return view('frontend.auth.register');
    }

    public function registerSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
            'terms' => ['required', 'accepted'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        SudamSweetAlert::toast('Success', 'You have successfully registered.');
        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('home'));
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $google_user = Socialite::driver('google')->user();

        $old_user = User::where('email', $google_user->email)->first();
        if (!$old_user) {
            $user = User::create([
                'name' => $google_user->name,
                'email' => $google_user->email,
                'password' => Hash::make(rand(10000, 99999)),
            ]);
            Auth::login($user);
        }else{
            Auth::login($old_user);
        }
        return redirect()->route('home');
    }
}

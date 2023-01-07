<?php

namespace App\Http\Controllers;

use App\Models\LoginToken;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::query()->where('email', '=', $data['email'])->first();
        if (!$user) {
            $user = new User([
                'name' => $data['email'],
                'email' => $data['email'],
                'password' => '123',
            ]);
            $user->save();
        }

        $user->sendLoginLink();
        session()->flash('success');

        return redirect()->back();
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();

        return redirect('/');
    }

    public function verifyLogin(Request $request, $token)
    {
        $token = LoginToken::query()->where('token', '=', hash('sha256', $token))->firstOrFail();
        $isValid = $token->expires_at->isAfter(now()) && $token->consumed_at == null;

        abort_unless($request->hasValidSignature() && $isValid, 401);

        $token->consumed_at = now();
        $token->save();

        Auth::login($token->user);

        return redirect('/');
    }
}

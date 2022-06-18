<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('login')->withErrors($validator)->withInput();
        }
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect('register');
        }

        $credentials = [
            'email' => $user->email,
            'password' => $request->password,
        ];

        if (!Auth::attempt($credentials)) {
            return redirect('login');
        }

        return redirect('posts');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('login');
    }
}

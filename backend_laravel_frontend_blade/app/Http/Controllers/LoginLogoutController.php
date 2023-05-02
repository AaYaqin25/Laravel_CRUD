<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginLogoutController extends Controller
{
    public function formLogin()
    {
        try {
            return view('loginform');
        } catch (\Throwable $th) {
        }
    }
    public function login(Request $request)
    {
        try {
            $userEmail = $request->input('email');
            $userPassword = $request->input('password');

            $user = User::where('email', $userEmail)->first();
            if (!$user || !$user->email || !Hash::check($userPassword, $user->password)) {
                return redirect()->back()->with('error', 'Invalid email or password');
            }

            session()->put('user', ['id' => $user->id, 'email' => $user->email, 'name' => $user->name]);
            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            dump($th);
        }
    }

    public function logout()
    {
        try {
            session()->forget('user');
            return redirect()->route('formlogin')->with('success', 'Logout successfully');
        } catch (\Throwable $th) {
            dump($th);
        }
    }
}

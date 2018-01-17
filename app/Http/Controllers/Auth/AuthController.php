<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use Session;

class AuthController extends Controller
{
    /**
     * Show Form Login.
     *
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Process Login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function login(Request $request)
    {
        $request->validate([
      'email' => 'required|email|max:50',
      'password' => 'required',
    ]);

        $user = User::where('email', $request->input('email'))->get();

        if ($user->count() != 0) {
            if (Hash::check($request->input('password'), $user[0]->password)) {
                Session::put('user', $user);

                return Redirect::route('start')->with(['message', 'Your successful login']);
            }
        }

        return Redirect::back()->withErrors(['Your passed incorrect data!']);
    }

    /**
     * Process Logout.
     *
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function logout()
    {
        Session::forget('user');

        return Redirect::route('login.index');
    }
}

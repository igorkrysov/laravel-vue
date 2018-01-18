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

        $user = User::where('email', $request->input('email'))->first();

        if ($user->count() != 0) {
            if (Hash::check($request->input('password'), $user->password)) {
                Session::put('user', $user);

                if ($user->reset == 1) {
                    return Redirect::route('change_password.index');
                }

                return Redirect::route('start')->with(['message_success' => 'Your successful login']);
            }
        }

        return Redirect::back()->withInput()->with(['message_danger' => 'Your passed incorrect data!']);
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

    /**
     * Show the form for reset a password.
     *
     * @return \Illuminate\Http\Response
     */
    public function change_password()
    {
        //
        return view("auth.reset");
        //return view("users.reset");
    }

    /**
     * Store new password.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_password(Request $request)
    {
        //
        $request->validate([
          'password' => 'required|string|min:6|confirmed',
        ]);


        $user = User::find((Session::get('user'))->id);
        $user->password = bcrypt($request->input('password'));
        $user->reset = 0;
        $user->save();

        return $this->logout()->with(['message_success' => 'Your password was changed! You need login again']);
        ;
    }
}

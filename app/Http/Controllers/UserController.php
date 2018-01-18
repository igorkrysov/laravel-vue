<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Group;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("user.users", ['users' => User::with('group')->get(['name','email','group_id']), 'groups' => Group::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $pass = str_random(8);
        //$pass = "123456Qw";

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($pass);
        $user->group_id = $request->input('group_id');
        $user->save();

        (new MailController())->send($request->input('name'), $pass, $request->input('email'));

        return Redirect::back()->with(['message_success' => 'User is added']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Show the form for reset a password.
     *
     * @return \Illuminate\Http\Response
     */
    public function reset_password()
    {
        //
        return view("user.reset");
        //return view("users.reset");
    }

    /**
     * Show the form for reset a password.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_password(Request $request)
    {
        //
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($request->input('password'));
        $user->reset = "0";
        $user->save();

        return redirect('/home');
    }
}

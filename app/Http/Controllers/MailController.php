<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use App\Http\Requests;
use Mail;

class MailController extends Controller
{
    public static function send($name, $password, $mail)
    {
        Mail::send('email.new-user', ['name' => $name, 'password' => $password], function ($message) use ($mail) {
            $message->to($mail)->subject("Registration");
        });
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class SessionController extends Controller
{
    //
    public function get_user_id(){
      return Response()->json(['user_id' => Session::get('user')->id]);
    }
}

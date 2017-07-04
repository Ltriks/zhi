<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function verify($token)
    {
        $user = User::where('confirmation_token',$token)->first();
        if(is_null($user)){
            flash('用户登录失败','warning');
            return redirect('/');
        }
        $user->is_active = 1;
        $user->confirmation_token = str_random(40);
        $user->save();
        flash('用户登录成功','success');

        Auth::login($user);
        return redirect('/home');
    }
}

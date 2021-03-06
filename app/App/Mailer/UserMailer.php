<?php

namespace App\Mailer;

use Mail;
use App\User;

class UserMailer extends Mailer
{
    public function followNotifyEmail($email)
    {
        $data = [
            'url' => 'http://zhi.trick.dev',
            'name' => user('api')->name,
        ];
        $this->sendTo('zhihu_app_new_user_follow', $email, $data);
    }

    public function passwordReset($token, $email)
    {
        $data = [
            'url' => url(config('app.url').route('password.reset', $token, false)),
        ];
        $this->sendTo('zhihu_app_password_reset', $email, $data);
    }

    public function emailVerify(User $user)
    {
        $data = [
            'url' => route('email.verify',['token' => $user->confirmation_token]),
            'name' => $user->name,
        ];
        $this->sendTo('zhihu_app_register', $user->email, $data);

    }
}
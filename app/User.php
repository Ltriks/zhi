<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Naux\Mail\SendCloudTemplate;
use Mail;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'confirmation_token',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function owns(Question $model) //Model $model doesn't work
    {
        return $this->id == $model->user_id;
    }

    public function follows($question_id)
    {
        return Follow::create([
            'question_id' => $question_id,
            'user_id' => $this->id // User::follows() $id == $this->id
        ]);
    }
    public function sendPasswordResetNotification($token)
    {
        $data = [
            'url' => url(config('app.url').route('password.reset', $token, false)),
        ];
        $template = new SendCloudTemplate('zhihu_app_password_reset', $data);

        Mail::raw($template, function ($message){
            $message->from('lqtriks@gmail.com', 'zhihu');
            $message->to($this->email);
        });
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class QuestionFollowController extends Controller
{
    public function follow($question_id)
    {
        Auth::user()->follows($question_id);

        return back();
    }
}

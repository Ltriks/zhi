<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function avatar()
    {
    	return view('users.avatar');
    }

    public function changeAvatar(Request $request)
    {
    	$file = $request->file('img');
    	$filename = md5(time().user()->id). '.' .$file->getClientoriginalExtension();
    	$file->move(public_path('avatars'), $filename);

    	user()->avatar = 'avatars/'.$filename;
    	user()->save();

    	return ['url' => user()->avatar];
    }
    // abandon for sony proxy
    // public function changeAvatar(Request $request)
    // {
    //     $file = $request->file('img');
    //     $filename = 'avatars/'.md5(time().user()->id). '.' .$file->getClientoriginalExtension();
    //     $disk = Storage::disk('qiniu');
    //     $disk->writeStream($filename, fopen($file->getRealPath(),'r'));

    //     user()->avatar = 'http://'.config('filesystems.disks.qiniu.domain').$filename;
    //     user()->save();

    //     return ['url' => user()->avatar];
    // }
}

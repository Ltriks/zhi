<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class settingController extends Controller
{
	public function index()
	{
		return view('users.setting');
	}
	public function store(Request $request)
	{
		dd((user()->settings));// $casts没生效 无法直接转化成数组 USER $casts
		$setting = array_merge(json_decode(user()->settings,true), array_only($request->all(),['city','bio']));

		user()->update(['settings' => $settings]);

		return back();
	}
}

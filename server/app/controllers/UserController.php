<?php

class UserController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	
	public function login()
	{
		$username = Input::get('username');
		$password = Input::get('password');

		if(!empty($username) && !empty($password))
		{
			if(Auth::attempt(array(
				'name'		=>	$username,
				'pass'		=>	$password
			)))
			{
				$user = Auth::user();
				$user->lasttime = time();
				$user->save();

				return Response::json(array(
					'success'	=>	1,
					'code'		=>	ConstConfig::USER_LOGIN_SUCCESS,
					'result'		=>	$user
				));
			}
			else
			{
				return Response::json(array(
					'success'	=>	0,
					'code'		=>	ConstConfig::USER_LOGIN_ERROR_AUTH_FAIL
				));
			}
		}
		else
		{
			return Response::json(array(
				'success'	=>	0,
				'code'		=>	ConstConfig::USER_LOGIN_ERROR_NO_PARAM
			));
		}
	}

	public function register()
	{
		$username = Input::get('username');
		$password = Input::get('password');

		if(!empty($username) && !empty($password))
		{
			$userCount = User::where('name', '=', $username)->count();
			if(empty($userCount))
			{
				$time = time();
				$user = new User;
				$user->name = $username;
				$user->pass = Hash::make($password);
				$user->email = '';
				$user->lasttime = $time;
				$user->regtime = $time;
				$user->save();

				return Response::json(array(
					'success'	=>	1,
					'code'		=>	ConstConfig::USER_REGISTER_SUCCESS,
					'result'		=>	$user
				));
			}
			else
			{
				return Response::json(array(
					'success'	=>	0,
					'code'		=>	ConstConfig::USER_REGISTER_ERROR_DUPLICATED
				));
			}
		}
		else
		{
			return Response::json(array(
				'success'	=>	0,
				'code'		=>	ConstConfig::USER_REGISTER_ERROR_NO_PARAM
			));
		}
	}

	public function start()
	{
		
	}

}

<?php

class RoleController extends BaseController {

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

	public function createRole()
	{
		$name = Input::get('name');

		if(!empty($name))
		{
			$count = Role::where('name', $name)->count();
			if($count == 0)
			{
				$role = new Role;
				$role->account_id = Auth::user()->id;
				$role->name = $name;
				$role->planet_count = 0;
				$role->planet_count_max = 1;
				$role->save();

				return Response::json(array(
					'success'		=>	1,
					'code'			=>	ConstConfig::CREATE_ROLE_SUCCESS,
					'result'		=>	$role
				));
			}
			else
			{
				return Response::json(array(
					'success'		=>	1,
					'code'			=>	ConstConfig::CREATE_ROLE_ERROR_DUPLICATED
				));
			}
		}
		else
		{
			return Response::json(array(
				'success'		=>	0,
				'code'			=>	ConstConfig::CREATE_ROLE_ERROR_NO_PARAM
			));
		}
	}

	public function getRoles()
	{
		$account_id = Input::get('id');

		if(!empty($account_id))
		{
			$roles = Role::where('account_id', $account_id)->get();
			
			return Response::json(array(
				'success'		=>	1,
				'code'			=>	ConstConfig::GET_ROLE_SUCCESS,
				'result'		=>	$roles
			));
		}
		else
		{
			return Response::json(array(
				'success'		=>	0,
				'code'			=>	ConstConfig::GET_ROLE_ERROR_NO_PARAM
			));
		}
	}

	public function chooseRole()
	{
		$role_id = Input::get('id');

		if(!empty($role_id))
		{
			$role = Role::find($role_id);
			if(!empty($role))
			{
				$account = Auth::user();
				if($account->id == $role->account_id)
				{
					$cookie = Cookie::make('role_id', $role->id);
					return Response::json(array(
						'success'		=>	1,
						'code'			=>	ConstConfig::CHOOSE_ROLE_SUCCESS
					))->withCookie($cookie);
				}
				else
				{
					return Response::json(array(
						'success'		=>	0,
						'code'			=>	ConstConfig::CHOOSE_ROLE_ERROR_NOT_MATCH
					));
				}
			}
			else
			{
				return Response::json(array(
					'success'		=>	0,
					'code'			=>	ConstConfig::CHOOSE_ROLE_ERROR_NOT_EXIST
				));
			}
		}
		else
		{
			return Response::json(array(
				'success'		=>	0,
				'code'			=>	ConstConfig::GET_ROLE_ERROR_NO_PARAM
			));
		}
	}

}

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

	public function getRoles()
	{
		$account_id = Input::get('account_id');

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

}

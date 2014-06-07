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
				$role->planet_count = 1;
				$role->planet_count_max = 1;
				$role->save();

				$basicConfig = MongoBasicConfig::first();
				$planetConfig = json_decode($basicConfig->planet);
				$count = MongoPlanetPositionCache::count();
				$position = MongoPlanetPositionCache::skip(rand(0, $count - 1))->first();
				$planet = new Planet;
				$planet->role_id = $role->id;
				foreach($planetConfig as $key => $value)
				{
					if($value === '{random_value}')
					{
						if($key == 'name')
						{
							$planet->$key = PlanetController::generatePlanetName();
						}
						elseif($key == 'position_starfield')
						{
							$planet->$key = mt_rand(0, $position->starfield);
						}
						elseif($key == 'position_constellation')
						{
							$planet->$key = mt_rand(0, $position->constellation);
						}
						elseif($key == 'position_galaxy')
						{
							$planet->$key = mt_rand(0, $position->galaxy);
						}
						elseif($key == 'position_index')
						{
							$planet->$key = mt_rand(0, $position->index);
						}
					}
					else
					{
						$planet->$key = $value;
					}
				}
				$planet->save();
				$position->delete();

				return Response::json(array(
					'success'		=>	1,
					'code'			=>	ConstConfig::CREATE_ROLE_SUCCESS,
					'result'		=>	$role,
					'planet'		=>	$planet
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

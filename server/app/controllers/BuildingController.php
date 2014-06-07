<?php

class BuildingController extends BaseController {

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

	public function get()
	{
		$planet_id = Input::get('id');

		if(!empty($planet_id))
		{
			$buildings = Building::where('planet_id', $planet_id)->get();

			return Response::json(array(
				'success'		=>	1,
				'code'			=>	ConstConfig::GET_BUILDING_SUCCESS,
				'result'		=>	$buildings
			));
		}
		else
		{
			return Response::json(array(
				'success'		=>	0,
				'code'			=>	ConstConfig::GET_BUILDING_ERROR_NO_PARAM
			));
		}
	}

}

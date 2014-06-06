<?php

class PlanetController extends BaseController {

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
		$starfield = Input::get('starfield');
		$constellation = Input::get('constellation');
		$galaxy = Input::get('galaxy');

		if(!empty($starfield) && !empty($constellation) && !empty($galaxy))
		{
			$planets = Planet::where('position_starfield', $starfield)
							->where('position_constellation', $constellation)
							->where('position_galaxy')->take(20)->get();

			return Response::json($planets);
		}
		else
		{
			return Response::json(array(
				'success'		=>	0,
				'code'			=>	ConstConfig::GET_PLANET_ERROR_NO_PARAM
			));
		}
	}

}

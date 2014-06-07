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

		if(is_numeric($starfield) && is_numeric($constellation) && is_numeric($galaxy))
		{
			$planets = Planet::where('position_starfield', $starfield)
							->where('position_constellation', $constellation)
							->where('position_galaxy', $galaxy)->take(20)->get();
			
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

	public static function generatePlanetName()
	{
		$chars = ['A','B','C','D','E','F','G','H','I',
		'J','K','L','M','N','O','P','Q','R','S','T',
		'U','V','W','X','Y','Z','0','1','2','3','4',
		'5','6','7','8','9'];

		shuffle($chars);
		$arr = array_slice($chars, 0, 6);
		array_splice($arr, 4, 0, array('-'));
		$str = implode($arr, '');
		
		return $str;
	}

}

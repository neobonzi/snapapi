<?php

use OAuth2\OAuth2;
use OAuth2\Token_Access;
use OAuth2\Exception as OAuth2_Exception;

class SessionController extends BaseController {

	public $restful = true;
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

	public function authenticate($provider)
	{
		$fbook_scope = 'read_friendlists, read_insights';

		switch ($provider) {
			case 'github':
				$id = '06aa90afffaf4f6e99a6';
				$secret = 'e50c95c55cc85be3e7798c4f598e7b5d8a5cf8e8';
				break;
			case 'facebook':
				$id = '676099882430333';
				$secret = 'a1406d01e1d0297dce676a14ded674ec';
		}

		$provider = OAuth2::provider($provider, array(
			'id' => $id,
			'secret' => $secret,
			'options' => array(
				'scope' => $fbook_scope
				),

		));

		if(!Input::get('code')) {
			return $provider->authorize();
		}
		else {
			try {
				$params = $provider->access(Input::get('code'));

				$token = new Token_Access(array(
					'access_token' => $params->access_token
				));

				$user_info = $provider->get_user_info($token);
				var_dump($user_info);
			}
			catch (OAuth2_Exception $e) {
				echo 'That didn\'t work: '.$e;
			}
		}
	}

}
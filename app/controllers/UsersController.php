<?php
use Support\Transformers\UserTransformer;
class UsersController extends APIController {

	public $restful = true;
	
	/**
	 * @var Support\Transformers\UserTransformer
	 */
	protected $userTransformer;

	function __construct(UserTransformer $userTransformer) {
		$this->userTransformer = $userTransformer;
		$this->beforeFilter('auth.token', ['except' => 'login']);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::all();
		return $this->respond($this->userTransformer->transformCollection($users->all()));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(!Input::get('username') or !Input::get('email') or !Input::get('password')) {
			return $this->respondUnprocessableEntity("Parameters failed validation for a user.");
		}

		$newUser = User::create([
			'username' => Input::get('username'), 
			'email' => Input::get('email'), 
			'password' => Hash::make(Input::get('password'))
		]);
		
		if(!$newUser) {
			$this->respondServerError("There was an error while creating a new user!");
		} else {
			return $this->login();
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::find($id);

		if (!$user) {
			return $this->respondNotFound("User with id ".$id." does not exist.");
		}
		return $this->respond($this->userTransformer->transform($user));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function login() {
		if(!Input::get('username') or !Input::get('password')) {
			return $this->respondUnprocessableEntity("Username and password fields required!");
		}
		$credentials = [
        	'username' => Input::get('username'),
        	'password' => Input::get('password')
    	];

		if(Auth::attempt($credentials)) {
			$authToken = AuthToken::create(Auth::user());
			$publicToken = AuthToken::publicToken($authToken);

			return $this->respond([
				'message' => "Successfully logged in!",
				'auth_token' => $publicToken
			]);
		} else {
			return $this->respondUnauthorized("Username and/or password are incorrect");
		}
	}

}

<?php
use Support\Transformers\UserTransformer;
use Support\Transformers\GroupTransformer;
use Support\Validation\UserValidator;

class UsersController extends APIController {

	/**
	 * @var boolean
	 */ 
	public $restful = true;

	/**
	 * @var array
	 */ 
	private $groupMessages = [
		'required' => "The :attribute field is required",
		'username.min' => ":attribute must be between :min and :max characters.",
		'username.max' => ":attribute must be between :min and :max characters.",
		'unique' => ":attribute already registered.",
		'email' => "Email must be well formed."
	];

	/**
	 * @var array
	 */ 
	private $userMessages = [
		'required' => "The :attribute field is required",
		'username.min' => ":attribute must be between :min and :max characters.",
		'username.max' => ":attribute must be between :min and :max characters.",
		'unique' => ":attribute already registered.",
		'email' => "Email must be well formed."
	];

	/**
	 * @var array
	 */ 
	private $userRules = [
		'username' => 'required|min:3|max:20|unique:users',
		'password' => 'required|min:8|max:20|unique:users',
		'email' => 'required|email|unique:users'
	];

	/**
	 * @var array
	 */ 
	private $groupRules = [
		'name' => 'required|min:3|max:20|unique:groups',
	];
	/**
	 * @var Support\Transformers\UserTransformer
	 */
	protected $userTransformer;
	protected $groupTransformer;
	/**
	 * @var Support\CustomValidationMessages
	 */
	protected $validationMessages;

	function __construct(UserTransformer $userTransformer, GroupTransformer $groupTransformer) {
		$this->userTransformer = $userTransformer;
		$this->groupTransformer = $groupTransformer;
		$this->beforeFilter('auth.token', ['except' => ['login','store','getUsers', 'destroy']]);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = User::find(Auth::user()->id);
		return $this->respond($this->userTransformer->transform($user));
	}

	/**
	 * Creates a new group given a group name and user id
	 * @param int $userId
	 * @return Response
	 */
	public function addUser($userId) {
		$validator = Validator::make(Input::all(), $this->userRules, $this->userMessages);
		if($validator->fails()) {
			$messages = implode(" ",$validator->messages()->all(":message"));
			return $this->respondUnprocessableEntity($messages);
		}

		$user = new User([
			'name' => e(Input::get('name'))
		]);

		$currentUser = User::find($userId);
		$currentUser->users()->save($user);
		return $this->respond([
			'data' =>
				[
					'id' => $user->id
				],
			'message' => "User successfully created"
		]);
	}

	public function getUsers()
	{
		$users = User::all();
		$transformedUsers = $this->userTransformer->transformCollection($users->all());

		return $this->respond([
			'data' => $transformedUsers
			]
		);
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

		$validator = Validator::make(Input::all(), $this->userRules, $this->userMessages);
		if($validator->fails()) {
			$messages = implode(" ",$validator->messages()->all(":message"));
			return $this->respondUnprocessableEntity($messages);
		}

		$newUser = User::create([
			'username' => e(Input::get('username')), 
			'email' => e(Input::get('email')), 
			'phone' => e(Input::get('phone')),
			'password' => Hash::make(Input::get('password')),
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
		return $this->setStatusCode(201)->respond($this->userTransformer->transform($user));
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
		User::destroy($id);

		return $this->setStatusCode(201)->respondWithMessage("User successfully deleted");
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
				'id' => Auth::user()->id,
				'username' => Auth::user()->username,
				'email' => Auth::user()->email,
				'auth_token' => $publicToken,
			]);
		} else {
			return $this->respondForbidden("Username and/or password are incorrect");
		}
	}

}

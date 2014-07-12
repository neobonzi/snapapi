<?php

use Support\Transformers\GroupTransformer;

class GroupsController extends APIController {
	protected $groupTransformer;

	private $groupMessages = [
		'required' => "The :attribute field is required",
		'username.min' => ":attribute must be between :min and :max characters.",
		'username.max' => ":attribute must be between :min and :max characters.",
		'unique' => ":attribute already registered.",
		'email' => "Email must be well formed."
	];

	private $groupRules = [
		'name' => 'required|min:3|max:20|unique:groups',
	];

	function __construct(GroupTransformer $groupTransformer) {
		$this->groupTransformer = $groupTransformer;
		$this->beforeFilter('auth.token', ['except' => ['getGroups', 'index', 'store', 'destroy']]);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index( )
	{
		$groups = Group::all();
		return $this->respond([
			'data' => $this->groupTransformer->transformCollection($groups->all())
		]);
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
	 * Returns a list of all groups. Mainly used for the bootstrapping.
	 * @return a list of all the groups.
	 */
	public function getGroups()
	{
		$transformedGroups = $this->groupTransformer->transformCollection(Group::all()->all());
		return $this->respond([
			'data' => $transformedGroups
			]
		);
	}

	/**
	 */
	public function putInvite($uid)
	{
		$validator = Validator::make(Input::all(), $this->inviteRules, $this->inviteMessages);
		if($validator->fails()) {
			$messages = implode(" ",$validator->messages()->all(":message"));
			return $this->respondUnprocessableEntity($messages);
		}

		$newInvite = Invite::create([
			'group' => e(Input::get('group'))
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), $this->groupRules, $this->groupMessages);
		if($validator->fails()) {
			$messages = implode(" ",$validator->messages()->all(":message"));
			return $this->respondUnprocessableEntity($messages);
		}

		$newGroup = Group::create([
			'name' => e(Input::get('name'))
		]);

		if(!$newGroup) {
			$this->respondServerError("There was an error while creating a new group!");
		} else {
			return $this->respond([
				'data' => $this->groupTransformer->transform($newGroup)
				]
			);
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
		//
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
		return $this->setStatusCode(201)->respondWithMessage("Group successfully deleted");
	}


}

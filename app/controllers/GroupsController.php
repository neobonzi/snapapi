<?php

use Support\Transformers\GroupTransformer;

class GroupsController extends APIController {
	protected $groupTransformer;

	function __construct(GroupTransformer $groupTransformer) {
		$this->groupTransformer = $groupTransformer;
		$this->beforeFilter('auth.token', ['except' => ['getGroups', 'destroy']]);
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
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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

<?php

class UsersController extends BaseController {


	public function index() {
		return 'Display all users';
	}

	public function create() {
		return View::make('auth.register');
	}

	public function store() {
		return 'Update a user';
	}

	public function show($userId) {
		return 'Show user '.$userId;
	}

	public function edit($userId) {
		return 'Edit user '.$userId;
	}

	public function destroy($userId) {
		return 'Delete user '.$userId;
	}


	public function authenticate($provider)
	{
		if(SessionController::authenticate($provider)) {
			return 'Logged in OKAY';
		}
		else {
			return 'Logged in like SHIT';
		}
	}

}
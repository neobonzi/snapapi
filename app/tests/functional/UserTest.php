<?php

class UserTest extends TestCase {
	
	public function testUsernameIsRequired() {
		//Create new User;
		$user = new User;
		$user->email = "test@ip.com";
		$user->password = "password";

		//This should not work
		$this->assertFalse($user->save());

		$errors = $user->errors()->all();
		$this->assertCount(1, $errors);
		$this->assertEquals($errors[0], "The username field is required.");
	}
}
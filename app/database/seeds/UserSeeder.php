<?php

class UserSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$numUsers = 10;

		for($i = 0; $i < $numUsers; $i++) {
			$user = new User;
			$user->email = 'player'.$i.'@snapapi.dev';
			$user->username = 'player'.$i;
			$user->password = Hash::make('password');
			$user->save();
		}
	}

}
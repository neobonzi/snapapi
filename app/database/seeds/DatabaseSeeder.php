<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		Eloquent::unguard();
		User::truncate();

		$this->call('UserSeeder');
		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}

}
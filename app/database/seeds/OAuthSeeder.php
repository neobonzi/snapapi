<?php

class OAuthSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		DB::table('oauth_clients')->insert(array(
			'name' => Hash::make('snapmobile'), 
			'secret' => Hash::make('snapmobile'.time())
		));
	}

}
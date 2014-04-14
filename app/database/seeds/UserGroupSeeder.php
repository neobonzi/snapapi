<?php

use Faker\Factory as Faker;

class UserGroupSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		$faker = Faker::create();
		$groupIds = Group::lists('id');
		$userIds = User::lists('id');

		foreach(range(1, 10) as $index) {
			DB::table('group_user')->insert([
				'group_id' => $faker->randomElement($groupIds),
				'user_id' => $faker->randomElement($userIds),
			]);
		}
	}

}
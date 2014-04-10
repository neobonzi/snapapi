<?php

class UserGroupSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$numGroups = 10;

		for($i = 0; $i < $numGroups; $i++) {
			$group = new Group;
			$group->name = 'Group '.$i;
			$group->save();
		}
	}

}
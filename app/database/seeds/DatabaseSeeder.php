<?php

class DatabaseSeeder extends Seeder {

	private $tables = [
		'users',
		'groups',
		'group_user'
	];
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->cleanDB();
		$this->call('UserSeeder');
		$this->call('GroupSeeder');
		$this->call('UserGroupSeeder');
	}

	private function cleanDB() {
		Eloquent::unguard();
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		foreach ($this->tables as $tableName) {
			DB::table($tableName)->truncate();
		}
		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}
<?php

use Faker\Factory as Faker;

class UserSeeder extends Seeder {

   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      Eloquent::unguard();
      $faker = Faker::create();
      $numUsers = 30;

      foreach(range(1,$numUsers) as $i){
         
         User::create([
            'email' => $faker->email(),
            'username' => $faker->userName(),
            'password' => Hash::make('sampleuser'),
            'phone' => $faker->phoneNumber()
         ]);
      }
      // Add the admin accounts
      User::create([
         'email' => 'snaphunt@gmail.com',
         'username' => 'snapadmin',
         'password' => Hash::make('makeitsnappy69'),
         'phone' => "805-208-1026",
         'admin' => true
      ]);
   }
}
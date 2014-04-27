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
      // Add the testing account
      User::create([
         'email' => $faker->email(),
         'username' => 'admin',
         'password' => Hash::make('admin'),
         'phone' => "699-699-9699"
      ]);
   }
}
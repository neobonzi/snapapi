<?php

use Faker\Factory as Faker;
use Faker\Generator as Generator;

class GroupSeeder extends Seeder {

   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      Eloquent::unguard();
      $faker = Faker::create();
      $numGroups = 10;

      foreach(range(1,$numGroups) as $i){
         Group::create([
            'name' => implode(" ", $faker->words(3)),
            
         ]);
      }
   }
}
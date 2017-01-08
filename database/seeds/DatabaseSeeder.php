<?php

use Illuminate\Database\Seeder;
use App\Item;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement("SET FOREIGN_KEY_CHECKS = 0");

      Item::truncate();
      User::truncate();

      factory(User::class,10)->create();
      factory(Item::class,30)->create();


    }
}

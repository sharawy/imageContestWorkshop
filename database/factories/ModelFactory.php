<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Item::class, function ($faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text(),
        'image_url' => "http://www.atlas-admin.com/images/placeholder.png",
        'user_id' => $faker->numberBetween(1,10),
        
    ];
});


$factory->define(App\User::class, function ($faker) {
    return [
        'full_name' => $faker->name,
        'email' => $faker->unique()->email,
        'password' => mt_rand(1,10),
        'mobile_number' => $faker->numberBetween(10000,10000000),
        'token' =>$faker->unique()->uuid
    ];
});

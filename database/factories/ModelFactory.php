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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        // 'password' => bcrypt(str_random(10)),
        'password' => bcrypt('password'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->text( 240 ),
        'name' => str_replace(' ', '-', $faker->unique()->text(230)),
        'description' => $faker->paragraph( rand(50,99) ),
        'status' => rand(1,0),
        'created_by' => rand(1,10),
        'category_id' => rand(1, 10),
    ];
});


$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->text( rand( 20, 40 ) ),
        'description' => $faker->paragraph( rand(10,20) ),
        'status' => rand(1,0),
    ];
});


$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->text( rand( 20, 40 ) ),
        'description' => $faker->paragraph( rand(10,20) ),
        'status' => rand(1,0),
    ];
});

$factory->define(App\Bookmarks::class, function (Faker\Generator $faker) {

    $bookmark_url = $faker->url;

    return [
        'title' => $faker->text( rand( 20, 40 ) ),
        'short_desc' => $faker->paragraph( rand(5,12) ),
        'details' => $faker->paragraph( rand(10,20) ),
        'bookmark_url' => $bookmark_url,
        'url_unique_key' => md5($bookmark_url),
    ];

});

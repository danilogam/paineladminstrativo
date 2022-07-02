<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => 'Sorocabacom',
        'role_id' => '1',
        'image' => NULL,
        'status' => 1,
        'username' => 'admin',
        'email' => 'dev@sorocabacom.com',
        'password' => bcrypt('master1qazZAQ!'),
        'remember_token' => '',
    ];
});

<?php

use Faker\Generator as Faker;

/* Factory para Postagens */
$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'status' => $faker->numberBetween(0,1),
        'categoria_id' => $faker->numberBetween(1,5),
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'summary' => $faker->paragraph($nbSentences = 2, $variableNbSentences = true),
        'content' => $faker->paragraph($nbSentences = 7, $variableNbSentences = true), // secret
        'image' => '',
        'keywords' => '',
        'description' => '',
    ];
});

/* Factory para Categorias */
$factory->define(App\Categoria::class, function (Faker $faker) {
    return [
        'label' => $faker->sentence($nbWords = 3, $variableNbWords = true)
    ];
});

/* Factory para Roles */
$factory->define(App\Role::class, function (Faker $faker) {
    return [
        'label' => $faker->sentence($nbWords = 3, $variableNbWords = true)
    ];
});

/* Factory para Informações */
$factory->define(App\Info::class, function (Faker $faker) {
    return [
        'scriptshead' => '<script></script>',
        'scriptsfoot' => '<script></script>',
        'googlemaps' => '<script></script>',
        'facebook' => $faker->freeEmailDomain(),
        'instagram' => $faker->freeEmailDomain(),
        'twitter' => $faker->freeEmailDomain(),
        'youtube' => $faker->freeEmailDomain(),
        'telefone' => $faker->e164PhoneNumber(),
        'email' => $faker->freeEmail(),
        'endereco' => $faker->address(),
    ];
});
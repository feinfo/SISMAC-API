<?php

use Faker\Generator as Faker;

$factory->define(App\Models\UserPerfil::class, function (Faker $faker) {
    return [
        'ds_descricao' => 'Administração'
    ];
});

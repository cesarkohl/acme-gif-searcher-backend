<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shorturl;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Shorturl::class, function (Faker $faker) {
    return [
        'code' => Str::random(50),
        'uri_code' => Str::random(100),
        'uri' => Str::random(100)
    ];
});

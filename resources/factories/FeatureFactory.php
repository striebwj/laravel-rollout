<?php

use Faker\Generator as Faker;

/**
 * Type def
 *
 * @var Factory $factory
 */

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;
use Jaspaul\LaravelRollout\Models\Feature;

$factory->define(Feature::class, function (Faker $faker) {
    $word = $faker->word;

    return [
       Feature::DB_NAME => $word,
       Feature::DB_SLUG => Str::slug($word),
       Feature::DB_DESCRIPTION => $faker->sentence,
    ];
});

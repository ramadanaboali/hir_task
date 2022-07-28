<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Ads;
use Faker\Generator as Faker;

$factory->define(Ads::class, function (Faker $faker) {
    return [
        'title' => $this->faker->title,
        'description' => $this->faker->text,
        'start_date' => $this->faker->date('Y-m-d'),
        'category_id' => \App\Models\Category::all()->random()->id,
        'advertiser_id' => \App\Models\Advertiser::all()->random()->id,
        'tags' => json_encode([\App\Models\Tag::all()->random()->id,\App\Models\Tag::all()->random()->id]),

    ];
});

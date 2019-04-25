<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\AdType;
use App\Models\Customer;
use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(AdType::class, function (Faker $faker) {
    return [
        'type' => $faker->name,
        'name' => $faker->name,
        'description' => $faker->sentence,
        'price' => $faker->randomFloat(2, 0, 1000)
    ];
});

$factory->defineAs(AdType::class, 'classic', function (Faker $faker) {
    return [
		'type' => 'classic',
		'name' => 'Classic Ad',
		'description' => 'Offer the most basic level of advertisement.',
		'price' => 269.99,
	];
});

$factory->defineAs(AdType::class, 'standout', function (Faker $faker) {
    return [
		'type' => 'standout',
		'name' => 'Standout Ad',
		'description' => 'Allows advertisers to use a company logo and use a longer presentation text.',
		'price' => 322.99,
	];
});

$factory->defineAs(AdType::class, 'premium', function (Faker $faker) {
    return [
		'type' => 'premium',
		'name' => 'Premium Ad',
		'description' => 'Same benefits as Standout Ad, but also puts the advertisement at the top of the results, allowing higher visibility.',
		'price' => 394.99
	];
});

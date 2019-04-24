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
        'price' => $faker->randomFloat(2, 0, 1000)
    ];
});

$factory->defineAs(AdType::class, 'classic', function (Faker $faker) {
    return [
		'type' => 'classic',
		'name' => 'Classic Ad',
		'price' => 269.99,
	];
});

$factory->defineAs(AdType::class, 'standout', function (Faker $faker) {
    return [
		'type' => 'standout',
		'name' => 'Standout Ad',
		'price' => 322.99,
	];
});

$factory->defineAs(AdType::class, 'premium', function (Faker $faker) {
    return [
		'type' => 'premium',
		'name' => 'Premium Ad',
		'price' => 394.99,
	];
});

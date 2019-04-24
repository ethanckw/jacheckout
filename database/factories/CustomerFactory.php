<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'logo' => $faker->name
    ];
});

$factory->defineAs(Customer::class, 'unilever', function (Faker $faker) {
    return [
		'name' => 'Unilever',
		'logo' => 'unilever.jpg'
	];
});

$factory->defineAs(Customer::class, 'apple', function (Faker $faker) {
    return [
		'name' => 'Apple',
		'logo' => 'apple.jpg'
	];
});

$factory->defineAs(Customer::class, 'nike', function (Faker $faker) {
    return [
		'name' => 'Nike',
		'logo' => 'nike.jpg'
	];
});

$factory->defineAs(Customer::class, 'ford', function (Faker $faker) {
    return [
		'name' => 'Ford',
		'logo' => 'ford.jpg'
	];
});


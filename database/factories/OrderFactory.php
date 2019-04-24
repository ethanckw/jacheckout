<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Customer;
use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'customer_id' => function () {
        	return factory(Customer::class)->create()->id;
    	}
    ];
});

$factory->defineAs(Order::class, 'unilever', function (Faker $faker) {
    return [
        'customer_id' => function () {
        	return factory(Customer::class, 'unilever')->create()->id;
    	}
    ];
});

$factory->defineAs(Order::class, 'apple', function (Faker $faker) {
    return [
        'customer_id' => function () {
        	return factory(Customer::class, 'apple')->create()->id;
    	}
    ];
});

$factory->defineAs(Order::class, 'nike', function (Faker $faker) {
    return [
        'customer_id' => function () {
        	return factory(Customer::class, 'nike')->create()->id;
    	}
    ];
});

$factory->defineAs(Order::class, 'ford', function (Faker $faker) {
    return [
        'customer_id' => function () {
        	return factory(Customer::class, 'ford')->create()->id;
    	}
    ];
});

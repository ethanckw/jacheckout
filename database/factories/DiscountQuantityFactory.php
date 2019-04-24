<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\AdType;
use App\Models\Customer;
use App\Models\DiscountQuantity;
use Faker\Generator as Faker;


$factory->defineAs(DiscountQuantity::class, 'apple-standout', function (Faker $faker) {
    return [
        'customer_id' => function () {
        	return factory(Customer::class, 'apple')->create()->id;
    	},
    	'ad_type_id' => function () {
        	return factory(AdType::class, 'standout')->create()->id;
    	},
		'min_quantity' => 1,
		'price_per_ad' => 299.99,
	];
});

$factory->defineAs(DiscountQuantity::class, 'nike-premium', function (Faker $faker) {
    return [
        'customer_id' => function () {
        	return factory(Customer::class, 'nike')->create()->id;
    	},
    	'ad_type_id' => function () {
        	return factory(AdType::class, 'premium')->create()->id;
    	},
		'min_quantity' => 4,
		'price_per_ad' => 379.99,
	];
});

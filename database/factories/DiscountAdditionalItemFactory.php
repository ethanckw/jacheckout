<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\AdType;
use App\Models\Customer;
use App\Models\DiscountAdditionalItem;
use Faker\Generator as Faker;


$factory->defineAs(DiscountAdditionalItem::class, 'unilever-classic', function (Faker $faker) {
    return [
        'customer_id' => function () {
        	return factory(Customer::class, 'unilever')->create()->id;
    	},
    	'ad_type_id' => function () {
        	return factory(AdType::class, 'classic')->create()->id;
    	},
		'min_quantity' => 2,
		'offered_quantity' => 3,
	];
});

$factory->defineAs(DiscountAdditionalItem::class, 'ford-classic', function (Faker $faker) {
    return [
        'customer_id' => function () {
        	return factory(Customer::class, 'ford')->create()->id;
    	},
    	'ad_type_id' => function () {
        	return factory(AdType::class, 'classic')->create()->id;
    	},
		'min_quantity' => 4,
		'offered_quantity' => 5,
	];
});

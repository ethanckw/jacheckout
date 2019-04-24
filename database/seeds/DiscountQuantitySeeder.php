<?php

use App\Models\DiscountQuantity;
use Illuminate\Database\Seeder;

class DiscountQuantitySeeder extends Seeder
{
    const INITIAL_DATA = [
		[
			'customer_id' => 2,
            'ad_type_id' => 2,
            'min_quantity' => 1,
            'price_per_ad' => 299.99
		],
		[
			'customer_id' => 3,
            'ad_type_id' => 3,
            'min_quantity' => 4,
            'price_per_ad' => 379.99
		],
		[
			'customer_id' => 4,
            'ad_type_id' => 2,
            'min_quantity' => 1,
            'price_per_ad' => 309.99
		],
		[
			'customer_id' => 4,
            'ad_type_id' => 2,
            'min_quantity' => 3,
            'price_per_ad' => 389.99
		]
	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	foreach (self::INITIAL_DATA as $data) {
    		DiscountQuantity::updateOrCreate(
    			[
    				'customer_id' => $data['customer_id'],
    				'ad_type_id' => $data['ad_type_id'],
    				'min_quantity' => $data['min_quantity']
                ],
                [
    				'price_per_ad' => $data['price_per_ad']
    			]
    		);
    	}
    }
}

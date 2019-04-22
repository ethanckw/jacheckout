<?php

use App\Models\DiscountAdditionalItem;
use Illuminate\Database\Seeder;

class DiscountAdditionalItemsSeeder extends Seeder
{
    const INITIAL_DATA = [
		[
			'customer_id' => 1,
            'ad_type_id' => 1,
            'min_quantity' => 2,
            'offered_quantity' => 3
		],
		[
			'customer_id' => 4,
            'ad_type_id' => 1,
            'min_quantity' => 4,
            'offered_quantity' => 5
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
    		DiscountAdditionalItem::updateOrCreate(
    			[
    				'customer_id' => $data['customer_id'],
    				'ad_type_id' => $data['ad_type_id']
    			],
    			[
    				'min_quantity' => $data['min_quantity'],
    				'offered_quantity' => $data['offered_quantity']
    			]
    		);
    	}
    }
}

<?php

use App\Models\AdType;
use Illuminate\Database\Seeder;

class AdTypesSeeder extends Seeder
{
	const INITIAL_DATA = [
		[
			'type' => 'classic',
			'name' => 'Classic Ad',
			'price' => 269.99,
		],
		[
			'type' => 'standout',
			'name' => 'Standout Ad',
			'price' => 322.99,
		],
		[
			'type' => 'premium',
			'name' => 'Premium Ad',
			'price' => 394.99,
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
    		AdType::updateOrCreate(
    			['type' => $data['type']],
    			[
    				'name' => $data['name'],
    				'price' => $data['price']
    			]
    		);
    	}
    }
}

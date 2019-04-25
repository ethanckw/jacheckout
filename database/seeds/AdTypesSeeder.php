<?php

use App\Models\AdType;
use Illuminate\Database\Seeder;

class AdTypesSeeder extends Seeder
{
	const INITIAL_DATA = [
		[
			'type' => 'classic',
			'name' => 'Classic Ad',
			'description' => 'Offer the most basic level of advertisement.',
			'price' => 269.99,
		],
		[
			'type' => 'standout',
			'name' => 'Standout Ad',
			'description' => 'Allows advertisers to use a company logo and use a longer presentation text.',
			'price' => 322.99,
		],
		[
			'type' => 'premium',
			'name' => 'Premium Ad',
			'description' => 'Same benefits as Standout Ad, but also puts the advertisement at the top of the results, allowing higher visibility.',
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
    				'description' => $data['description'],
    				'price' => $data['price']
    			]
    		);
    	}
    }
}

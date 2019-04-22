<?php

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomersSeeder extends Seeder
{
	const INITIAL_DATA = [
		[
			'name' => 'Unilever',
			'logo' => 'unilever.jpg'
		],
		[
			'name' => 'Apple',
			'logo' => 'apple.jpg'
		],
		[
			'name' => 'Nike',
			'logo' => 'nike.jpg'
		],
		[
			'name' => 'Ford',
			'logo' => 'ford.jpg'
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
    		Customer::updateOrCreate(
    			['name' => $data['name']],
    			['logo' => $data['logo']]
    		);
    	}
    }
}

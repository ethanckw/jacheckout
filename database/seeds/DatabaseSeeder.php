<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdTypesSeeder::class);
        $this->call(CustomersSeeder::class);
        $this->call(DiscountQuantitySeeder::class);
        $this->call(DiscountAdditionalItemsSeeder::class);
    }
}

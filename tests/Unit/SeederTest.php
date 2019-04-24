<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\AdType;
use App\Models\Customer;
use App\Models\DiscountAdditionalItem;
use App\Models\DiscountQuantity;
use Tests\TestCase;
use \AdTypesSeeder;
use \CustomersSeeder;
use \DiscountAdditionalItemsSeeder;
use \DiscountQuantitySeeder;

class SeederTest extends TestCase
{
    use RefreshDatabase;

	protected function setUp(): void
	{
		parent::setUp();

		$this->seed();
	}

    public function testInitialSeedDataCount()
    {
        $this->assertSame(count(AdTypesSeeder::INITIAL_DATA), AdType::count());
        $this->assertSame(count(CustomersSeeder::INITIAL_DATA), Customer::count());
        $this->assertSame(count(DiscountQuantitySeeder::INITIAL_DATA), DiscountQuantity::count());
        $this->assertSame(count(DiscountAdditionalItemsSeeder::INITIAL_DATA), DiscountAdditionalItem::count());
    }
}

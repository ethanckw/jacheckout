<?php

namespace Tests\Unit;

use App\Models\Customer;
use App\Models\Order;
use App\Services\CustomerService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CustomerServiceTest extends TestCase
{
    use DatabaseTransactions;

    private $customerService;

	protected function setUp(): void
	{
		parent::setUp();

        $this->customerService = app()->make(CustomerService::class);
	}

    public function testCreateOrder()
    {
        $customer = factory(Customer::class)->create();

        $order = $this->customerService->createOrder($customer);

        $this->assertInstanceOf(Order::class, $order);
        $this->assertSame($order->id, $customer->orders->last()->id);
    }
}

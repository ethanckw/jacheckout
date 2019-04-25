<?php

namespace Tests\Unit;

use App\Models\AdType;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\OrderService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class OrderServiceTest extends TestCase
{
    use DatabaseTransactions;

    private $orderService;

	protected function setUp(): void
	{
		parent::setUp();

        $this->orderService = app()->make(OrderService::class);
	}

    public function testAddItem()
    {
        $order = factory(Order::class)->create();
        $ad = factory(AdType::class)->create();

        $order = $this->orderService->addItem($order, $ad);

        $this->assertSame($order->gross_price, $ad->price);
    }
}

<?php

namespace Tests\Unit;

use App\Models\AdType;
use App\Models\Order;
use App\Services\OrderItemService;
use App\Services\OrderService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class NoDiscountTest extends TestCase
{
    use DatabaseTransactions;

    private $orderService;
    private $orderItemService;

	protected function setUp(): void
	{
		parent::setUp();

        $this->orderService = app()->make(OrderService::class);
        $this->orderItemService = app()->make(OrderItemService::class);
	}

    public function testAddItem()
    {
        $order = factory(Order::class)->create();
        $classicAd = factory(AdType::class, 'classic')->create();
        $standoutAd = factory(AdType::class, 'standout')->create();
        $premiumAd = factory(AdType::class, 'premium')->create();

        $this->orderService->addItem($order, $classicAd);
        $this->orderService->addItem($order, $standoutAd);
        $this->orderService->addItem($order, $premiumAd);
        $this->orderService->getPrices($order);

        $this->assertSame($classicAd->price + $standoutAd->price + $premiumAd->price, $order->gross_price);
        $this->assertSame(987.97, $order->net_price);
    }
}

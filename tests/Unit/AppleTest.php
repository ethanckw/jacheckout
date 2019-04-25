<?php

namespace Tests\Unit;

use App\Models\AdType;
use App\Models\DiscountQuantity;
use App\Models\Order;
use App\Services\OrderItemService;
use App\Services\OrderService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AppleTest extends TestCase
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
        $order = factory(Order::class, 'apple')->create();
        $standoutAd = factory(AdType::class, 'standout')->create();
        $premiumAd = factory(AdType::class, 'premium')->create();
        factory(DiscountQuantity::class, 'apple-standout')->create([
            'customer_id' => $order->customer->id,
            'ad_type_id' => $standoutAd->id
        ]);

        $this->orderService->addItem($order, $standoutAd);
        $orderItem = $order->orderItems->first();
        $this->orderItemService->add($orderItem);
        $this->orderItemService->add($orderItem);

        $this->orderService->addItem($order, $premiumAd);
        $order->load('orderItems');
        $this->orderService->getPrices($order);

        $this->assertSame(1, count($this->orderItemService->getDiscountQuantities($orderItem)));
        $this->assertSame($standoutAd->price * 3 + $premiumAd->price, $order->gross_price);
        $this->assertSame(1294.96, $order->net_price);
    }
}

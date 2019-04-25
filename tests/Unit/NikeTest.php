<?php

namespace Tests\Unit;

use App\Models\AdType;
use App\Models\DiscountQuantity;
use App\Models\Order;
use App\Services\OrderItemService;
use App\Services\OrderService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class NikeTest extends TestCase
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
        $order = factory(Order::class, 'nike')->create();
        $premiumAd = factory(AdType::class, 'premium')->create();
        factory(DiscountQuantity::class, 'nike-premium')->create([
            'customer_id' => $order->customer->id,
            'ad_type_id' => $premiumAd->id
        ]);

        $this->orderService->addItem($order, $premiumAd);
        $orderItem = $order->orderItems->first();

        $this->orderItemService->add($orderItem);
        $this->orderItemService->add($orderItem);
        $this->orderItemService->add($orderItem);
        $order->load('orderItems');
        $this->orderService->getPrices($order);

        $this->assertSame(1, count($this->orderItemService->getDiscountQuantities($orderItem)));
        $this->assertSame($premiumAd->price * 4, $order->gross_price);
        $this->assertSame(1519.96, $order->net_price);
    }
}

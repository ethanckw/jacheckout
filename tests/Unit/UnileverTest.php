<?php

namespace Tests\Unit;

use App\Models\AdType;
use App\Models\DiscountAdditionalItem;
use App\Models\Order;
use App\Services\OrderItemService;
use App\Services\OrderService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UnileverTest extends TestCase
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
        $order = factory(Order::class, 'unilever')->create();
        $classicAd = factory(AdType::class, 'classic')->create();
        $premiumAd = factory(AdType::class, 'premium')->create();
        factory(DiscountAdditionalItem::class, 'unilever-classic')->create([
            'customer_id' => $order->customer->id,
            'ad_type_id' => $classicAd->id
        ]);

        $this->orderService->addItem($order, $classicAd);
        $orderItem = $order->orderItems->first();
        $this->orderItemService->add($orderItem);
        $this->orderItemService->add($orderItem);

        $this->orderService->addItem($order, $premiumAd);
        $order->load('orderItems');
        $this->orderService->getPrices($order);

        $this->assertSame(1, count($this->orderItemService->getDiscountAdditionalItems($orderItem)));
        $this->assertSame($classicAd->price * 3 + $premiumAd->price, $order->gross_price);
        $this->assertSame(934.97, $order->net_price);
    }
}

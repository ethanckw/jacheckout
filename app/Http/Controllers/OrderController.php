<?php

namespace App\Http\Controllers;

use App\Models\AdType;
use App\Models\Customer;
use App\Models\DiscountAdditionalItem;
use App\Models\DiscountQuantity;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CustomerService;
use App\Services\OrderItemService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function create($customerId)
    {
    	$customer = Customer::findOrFail($customerId);

    	$order = (new CustomerService)->createOrder($customer);

    	return $order->load(['customer', 'orderItems.adType']);
    }

    public function addItem($orderId, $adTypeId)
    {
    	$order = Order::findOrFail($orderId);
    	$adType = AdType::findOrFail($adTypeId);

    	return (new OrderService)->addItem($order, $adType);
    }

    public function add($orderItemId)
    {
        $orderItem = OrderItem::findOrFail($orderItemId);


        (new OrderItemService)->add($orderItem);
        return (new OrderService)->getPrices($orderItem->order);
    }

    public function remove($orderItemId)
    {
        $orderItem = OrderItem::findOrFail($orderItemId);

        (new OrderItemService)->remove($orderItem);
        return (new OrderService)->getPrices($orderItem->order);
    }

    public function getAds($customerId)
    {
        $discountQty = DiscountQuantity::where('customer_id', $customerId)->get();
        $discountAdditionalItems = DiscountAdditionalItem::where('customer_id', $customerId)->get();
        $discounts = $discountQty->concat($discountAdditionalItems);

        return [
            'ads' => AdType::all(),
            'discounts' => $discounts
        ];
    }
}

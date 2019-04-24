<?php

namespace App\Services;

use App\Models\AdType;
use App\Models\Order;
use App\Models\OrderItem;

class OrderService
{
    public function addItem(Order $order, AdType $ad)
    {
    	$orderItem = new OrderItem([
    		'ad_type_id' => $ad->id,
    		'gross_price' => $ad->price,
    		'net_price' => $ad->price,
    		'quantity' => 1,
    	]);

		$order->orderItems()->save($orderItem);

    	return $orderItem;
    }

    public function getPrices(Order $order)
    {
    	$order->gross_price = $order->orderItems->sum('gross_price');
    	$order->net_price = $order->orderItems->sum('net_price');
    	$order->save();

    	return $order;
    }
}

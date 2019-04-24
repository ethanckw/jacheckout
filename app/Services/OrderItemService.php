<?php

namespace App\Services;

use App\Models\AdType;
use App\Models\DiscountAdditionalItem;
use App\Models\DiscountQuantity;
use App\Models\Order;
use App\Models\OrderItem;

class OrderItemService
{
    public function getDiscountQuantities(OrderItem $orderItem)
    {
        return DiscountQuantity::where('customer_id', $orderItem->order->customer->id)
            ->where('ad_type_id', $orderItem->ad_type_id)
            ->where('min_quantity', '<=', $orderItem->quantity)
            ->get();
    }

    public function getDiscountAdditionalItems(OrderItem $orderItem)
    {
        return DiscountAdditionalItem::where('customer_id', $orderItem->order->customer->id)
            ->where('ad_type_id', $orderItem->ad_type_id)
            ->where('min_quantity', '<=', $orderItem->quantity)
            ->get();
    }

    public function calculateNetPrice(OrderItem $orderItem)
    {
        $ad = AdType::find($orderItem->ad_type_id);
        $orderItem->net_price = $orderItem->quantity * $ad->price;
        $orderItem->save();

        $discount = $this->getDiscountQuantities($orderItem)->first();
        if (!empty($discount)) {
            $orderItem->net_price = $orderItem->quantity * $discount->price_per_ad;
            $orderItem->save();
        } else {
            $discount = $this->getDiscountAdditionalItems($orderItem)->first();
            if (!empty($discount)) {
                $multiplePrice = floor($orderItem->quantity/$discount->offered_quantity) * $discount->min_quantity * $ad->price;
                $remainderPrice = $orderItem->quantity%$discount->offered_quantity * $ad->price;

                $orderItem->net_price = $multiplePrice + $remainderPrice;
                $orderItem->save();
            }
        }
    }

    public function calculateGrossPrice(OrderItem $orderItem)
    {
        $ad = AdType::find($orderItem->ad_type_id);
        $orderItem->gross_price = $ad->price * $orderItem->quantity;
        $orderItem->save();
    }

    public function add(OrderItem $orderItem)
    {
        $orderItem->quantity = $orderItem->quantity + 1;
        $orderItem->save();

        $this->calculateGrossPrice($orderItem);
        $this->calculateNetPrice($orderItem);

        return $orderItem;
    }

    public function remove(OrderItem $orderItem)
    {
        if ($orderItem->quantity === 1) {
            $orderItem->delete();
        } else {
            $orderItem->quantity = $orderItem->quantity - 1;
            $orderItem->save();

            $this->calculateGrossPrice($orderItem);
            $this->calculateNetPrice($orderItem);
        }
    }
}

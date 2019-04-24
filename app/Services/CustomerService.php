<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Order;

class CustomerService
{
    public function createOrder(Customer $customer)
    {
    	$order = new Order;
    	$customer->orders()->save($order);

    	return $order;
    }
}

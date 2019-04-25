<?php

use App\Models\AdType;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/orders', function () {
    return Order::all()->sortByDesc('created_at')->map(function ($order) {
    	return [
    		'id' => $order->id,
            'customer' => $order->customer->name ?? '',
            'status' => $order->status ?? '',
            'gross_price' => $order->gross_price,
            'net_price' => $order->net_price,
            'created_at' => $order->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $order->updated_at->format('Y-m-d H:i:s'),
    	];
    })->values();
});

Route::get('/customers', function () {
    return Customer::all();
});

Route::get('/ads', function () {
    return AdType::all();
});

Route::get('/order/{orderId}', function ($orderId) {
    return Order::with(['customer', 'orderItems.adType'])->findOrFail($orderId);
});

Route::post('/order/{customerId}', 'OrderController@create');
Route::post('/order/{orderId}/ad/{adTypeId}', 'OrderController@addItem');
Route::post('/orderItem/{orderItemId}/add', 'OrderController@add');
Route::post('/orderItem/{orderItemId}/remove', 'OrderController@remove');

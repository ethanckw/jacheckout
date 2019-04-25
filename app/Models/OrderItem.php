<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'ad_type_id', 'quantity', 'gross_price', 'net_price'];

    public function order()
    {
    	return $this->belongsTo(Order::class);
    }

    public function adType()
    {
    	return $this->belongsTo(AdType::class);
    }
}

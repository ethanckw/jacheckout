<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountQuantity extends Model
{
    protected $fillable = ['customer_id', 'ad_type_id', 'min_quantity', 'price_per_ad'];
}

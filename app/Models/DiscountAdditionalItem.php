<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountAdditionalItem extends Model
{
    protected $fillable = ['customer_id', 'ad_type_id', 'min_quantity', 'offered_quantity'];
}

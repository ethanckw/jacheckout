<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdType extends Model
{
    protected $fillable = ['type', 'name', 'description', 'price'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }
}

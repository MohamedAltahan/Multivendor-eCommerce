<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;


    // relations============================================================
    function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    function product()
    {
        return $this->belongsTo(Product::class);
    }

    function order()
    {
        return $this->belongsTo(order::class);
    }
}

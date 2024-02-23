<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    //relations======================================
    function user()
    {
        return $this->belongsTo(User::class);
    }

    function product()
    {
        return $this->belongsTo(Product::class);
    }
}

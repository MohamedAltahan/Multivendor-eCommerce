<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'product_key'];

    function product()
    {

        return $this->belongsTo(Product::class, 'product_key', 'product_key');
    }
}

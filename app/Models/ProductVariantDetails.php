<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantDetails extends Model
{
    use HasFactory;
    protected $fillable = ['product_variant_id', 'product_id', 'variant_value', 'price', 'status', 'is_default'];

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id', 'id');
    }
}

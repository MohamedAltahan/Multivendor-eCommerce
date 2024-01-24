<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantDetails extends Model
{
    use HasFactory;
    protected $fillable = ['product_variant_type_id', 'product_id', 'variant_value', 'price', 'status', 'is_default'];


    public function variantType()
    {
        return $this->belongsTo(ProductVariantType::class, 'product_variant_type_id', 'id');
    }
}

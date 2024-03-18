<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id', 'variant_price', 'variant_image', 'product_variant_type_id',
        'product_variant_detail_id', 'status', 'is_default', 'quantity'
    ];


    public function type()
    {
        return $this->belongsTo(ProductVariantType::class, 'product_variant_type_id', 'id');
    }

    public function values()
    {
        return $this->belongsTo(VariantDetails::class, 'product_variant_detail_id', 'id');
    }
}

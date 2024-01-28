<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'name', 'status', 'vendor_id'];


    // public function productVariantDetails()
    // {
    //     return $this->hasMany(ProductVariantDetails::class, 'product_variant_type_id', 'id');
    // }

    public function type()
    {
        return $this->belongsTo(ProductVariantType::class, 'product_variant_type_id', 'id');
    }

    public function values()
    {
        return $this->hasMany(ProductVariantDetails::class, 'product_variant_type_id', 'product_variant_type_id');
    }
}

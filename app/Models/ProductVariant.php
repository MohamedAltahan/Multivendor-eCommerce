<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'name', 'status', 'vendor_id'];


    public function productVariantDetails()
    {
        return $this->hasMany(ProductVariantDetails::class, 'product_variant_id', 'id');
    }
}

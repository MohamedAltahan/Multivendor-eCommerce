<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantDetails extends Model
{
    use HasFactory;
    protected $fillable = ['product_variant_type_id',  'variant_value',  'status'];


    public function variantType()
    {
        return $this->belongsTo(ProductVariantType::class, 'product_variant_type_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantType extends Model
{
    use HasFactory;
    protected $fillable = ['attribute', 'value', 'attribute_code'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'image', 'product_key', 'vendor_id', 'category_id', 'sub_category_id',
        'child_category_id', 'brand_id', 'quantity', 'short_description', 'long_description',
        'video_link', 'sku', 'price', 'offer_price', 'offer_start_date',
        'offer_end_date', 'status', 'product_type',
        'is_approved', 'seo_title', 'seo_description', 'slug'
    ];
    //relations==============================================================================
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(ProductImages::class, 'product_key', 'product_key');
    }

    public function firstImage()
    {
        return $this->hasOne(ProductImages::class, 'product_key', 'product_key');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }
}

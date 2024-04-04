<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'banner', 'phone', 'email', 'status',
        'address', 'description', 'user_id', 'fb_link',
        'tw_link', 'insta_link', 'shop_name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'vendor_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }
}

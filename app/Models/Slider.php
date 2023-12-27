<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'banner_image', 'type', 'title', 'starting_price',
        'banner_url', 'serial', 'status'
    ];
}

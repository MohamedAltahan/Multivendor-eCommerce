<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class withdrawMethod extends Model
{
    use HasFactory;
    protected $fillable = [

        'name',
        'minimum_amount',
        'maximum_amount',
        'withdraw_charge',
        'description',
    ];
}

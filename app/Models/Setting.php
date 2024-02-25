<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'currency_symbol', 'site_name', 'layout', 'contact_email',
        'contact_address', 'contact_phone', 'currency', 'time_zone', 'map'
    ];
}

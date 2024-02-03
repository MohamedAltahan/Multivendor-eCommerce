<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaypalSetting extends Model
{
    use HasFactory;
    protected $fillable = ['status', 'mode', 'country', 'exchange_rate', 'currency', 'clint_id', 'secret_key'];
}

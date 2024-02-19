<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class footerTitle extends Model
{
    use HasFactory;
    protected $fillable = ['footer_section_two_title', 'footer_section_three_title'];
}

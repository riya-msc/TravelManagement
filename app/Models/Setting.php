<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_information',
        'company_socials',
        'company_banners',
        'company_about',
        'company_t&c',
        'company_services',
    ];
}

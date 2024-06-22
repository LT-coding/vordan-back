<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessAccount extends Model
{
use HasFactory, SoftDeletes;

    protected $fillable = [
        'business_id', 'tax_code', 'register_code', 'registered_address', 'activity_address'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'coupon_code', 'start_date', 'end_date', 'discount', 
    'discount_type', 'max_use', 'use_count', 'status', 'added_by', 'apply_on', 'min_cart_value', 'product_id', 'category_id'];
    protected $table = "coupon";
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationProduct extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'variation_id', 'products',];
    protected $table = "product_variation";
}

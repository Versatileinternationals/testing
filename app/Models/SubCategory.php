<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'subcategory_id', 'category_id', 'image', 'status'];
    protected $table = "sub_category";

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
}

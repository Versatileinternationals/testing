<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerAccount extends Model
{ 
    use HasFactory;
   // protected $fillable = ['JobName', 'JobType', 'Location', 'Salary', 'JobAddress','Status'];
    protected $table = "users";

    // public function category()
    // {
    //     return $this->belongsTo('App\Models\Category', 'category_id');
    // }

    // public function subcategory()
    // {
    //     return $this->belongsTo('App\Models\SubCategory', 'subcategory_id');
    // }

    // public function brandData()
    // {
    //     return $this->belongsTo('App\Models\Brand', 'brand');
    // }
}

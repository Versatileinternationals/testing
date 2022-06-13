<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlzSelfPaced extends Model
{
    use HasFactory;
    protected $fillable = ['CourseName','StreamName','CourseType','id','Title','Video', 'VideoCategory', 'VideoDescription','Status'];
    protected $table = "Blz_selfpaced_learning";

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

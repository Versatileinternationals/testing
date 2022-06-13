<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlzOnlineQuiz extends Model
{
    use HasFactory;
    protected $fillable = ['title','questions', 'duration', 'exam_to','exam_from','Status'];
    protected $table = "Blz_online_quiz";

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

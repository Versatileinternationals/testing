<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlzTraining extends Model
{
    use HasFactory;
    protected $fillable = ['CourseName', 'StreamName', 'TrainingName', 'trainingFees','FacilitatorName','FacilitatorDescription','TrainingDuration', 'TrainingStartDate', 'TrainingDescription', 'TrainingImage', 'TrainingVideo','Status'];
    protected $table = "BlzInvst_training";

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

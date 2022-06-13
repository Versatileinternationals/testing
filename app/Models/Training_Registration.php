<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training_Registration extends Model
{
    use HasFactory;
    protected $fillable = [
            'first_name', 
            'last_name',
            'email' ,
            'street_address',
            'phone',
            'gender', 
            'ethnicity',
            'business_name',
            'ownership_type',
            'business_register',
            'establishment_year',
            'current_focus',
            'city',
            'age',
            'learn_topic',
            'industry',
            'current_employement',
            'higest_education',
            'training_id',
            'user_id'
            ];
    protected $table = "Training_Registration";

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

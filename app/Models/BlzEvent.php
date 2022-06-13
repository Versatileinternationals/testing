<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlzEvent extends Model
{
    use HasFactory;
    protected $fillable = ['EventName', 'StartDate','EndDate' ,'EventTime','EventType', 'Event_fees', 'EventAddress', 'EventImage', 'Description','Status'];
    protected $table = "BlzInvst_EventListing";

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

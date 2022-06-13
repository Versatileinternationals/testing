<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotations extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'seller_id', 'name', 'service', 'qty', 'unit', 'phone', 'email', 'quotation_status', 'status'];
    
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Models\SubCategory', 'subcategory_id');
    }

    public function brandData()
    {
        return $this->belongsTo('App\Models\Brand', 'brand');
    }
    public function status()
    {
        return $this->belongsTo('App\Models\Brand', 'status');
    }
    
}

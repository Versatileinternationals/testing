<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status'];
    protected $table = "Service_Category";

public function ServiceCategory()
    {
        return $this->belongsTo('App\Models\ServiceCategory', 'category');
    }
	
}
	
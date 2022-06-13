<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Add_Training_Mo extends Model
{ 
    use HasFactory;
    protected $fillable = ['course','model_name','topic_name'];
    protected $table = "Add_Training_Mos";

    
}

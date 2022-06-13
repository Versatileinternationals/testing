<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddSubTopic extends Model
{ 
    use HasFactory;
     protected $fillable = ['training_id','subtop_name','status'];
    protected $table = "AddsubTopics";

    
}

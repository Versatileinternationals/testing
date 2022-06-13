<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlzTrainee extends Model
{ 
    use HasFactory;
    protected $fillable = ['name','score','courses','cerificates','EmpStatus','Status'];
    protected $table = "BlzInvst_trainees";

}


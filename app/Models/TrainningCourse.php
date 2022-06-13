<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainningCourse extends Model
{
    use HasFactory;
    protected $fillable = ['stream_id','Course_Name', 'Status'];
    protected $table = "Trainning_Course"; 
}

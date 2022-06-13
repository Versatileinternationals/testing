<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{ 
    use HasFactory;
   // protected $fillable = ['JobName', 'JobType', 'Location', 'Salary', 'JobAddress','Status'];
    protected $table = "users";

    
}

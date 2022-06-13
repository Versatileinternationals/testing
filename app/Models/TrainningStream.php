<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainningStream extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status'];
    protected $table = "BlzInvest_Trainning_Stream"; 
}

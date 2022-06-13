<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlzQueryList extends Model
{ 
    use HasFactory;
    protected $fillable = ['title','querys','Status'];
    protected $table = "BlzInvst_QueryList";

}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blz_resources extends Model
{ 
    use HasFactory;
    protected $fillable = ['name','links','Status'];
    protected $table = "blz_resources";

    
}

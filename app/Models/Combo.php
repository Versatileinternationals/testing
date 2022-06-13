<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    use HasFactory;
    protected $fillable = ['combo_id', 'name', 'products', 'price', 'status', 'added_by'];
    protected $table = "combo";

    
}

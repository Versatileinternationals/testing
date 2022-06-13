<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlzGrantSection extends Model
{
    use HasFactory;
    protected $fillable = ['url', 'image','Status'];
    protected $table = "BlzInvest_Grant_Section";

    
}

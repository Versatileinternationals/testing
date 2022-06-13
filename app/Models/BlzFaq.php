<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlzFaq extends Model
{ 
    use HasFactory;
    protected $fillable = ['Title','description','added_by','Status'];
    protected $table = "BlzInvest_Faq";

}


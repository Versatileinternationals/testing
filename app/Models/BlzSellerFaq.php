<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlzSellerFaq extends Model
{ 
    use HasFactory;
    protected $fillable = ['Title','description','Status'];
    protected $table = "BlzInvest_SellerFaq";

}


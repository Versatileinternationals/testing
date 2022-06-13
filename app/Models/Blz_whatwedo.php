<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blz_whatwedo extends Model
{ 
    use HasFactory;
    protected $fillable = ['image','Status','description'];
    protected $table = "blz_what_we_do";

    
}

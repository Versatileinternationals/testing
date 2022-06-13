<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blz_team_member extends Model
{ 
    use HasFactory;
    protected $fillable = ['name','designation','image','Status','description'];
    protected $table = "blz_team_members";

    
}

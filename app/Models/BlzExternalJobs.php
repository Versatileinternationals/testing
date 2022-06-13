<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlzExternalJobs extends Model
{ 
    use HasFactory;
    protected $fillable = ['external_links','Status'];
    protected $table = "BlzInvst_Externaljobs";

}


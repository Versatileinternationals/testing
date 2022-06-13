<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlzJobsPreparedness extends Model
{ 
    use HasFactory;
    protected $fillable = ['job_content','description','youtube_video','Status'];
    protected $table = "BlzInvst_jobpreparedness";

}


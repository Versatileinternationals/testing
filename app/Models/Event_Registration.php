<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event_Registration extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name','email' ,'country','job_title', 'organization', 'event_id','Status'];
    protected $table = "Event_Registration";

   
}

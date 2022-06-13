<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlzJobs extends Model
{ 
    use HasFactory;
    protected $fillable = ['JobName', 'JobType','company_name' ,'experience','job_skills','description','JobImage','Salary', 'JobAddress','Status'];
    protected $table = "BlzInvst_jobs";

}
class JobPrepared extends Model
{
    // models your "cars" table

    //use HasJsonDetails;
}

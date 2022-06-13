<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request_Assistance extends Model
{
    use HasFactory;
    protected $fillable = ['name','admin_type','email' ,'phone','description', 'business','Status'];
    protected $table = "Request_Assistance";

   
}

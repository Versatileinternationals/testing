<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $fillable = ['banner_id', 'title', 'description', 'image', 'status', 'url', 'added_by'];
    protected $table = "banner"; 
}

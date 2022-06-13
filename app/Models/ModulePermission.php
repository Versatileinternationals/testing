<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulePermission extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['role_id', 'module_id'];
    
}

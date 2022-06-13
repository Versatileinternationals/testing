<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraineeProfile extends Model
{
    protected $table = "trainee_profile";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trainee_id',
        'est_date',
        'description',
        'website_url',
        'status'
    ];

    
}

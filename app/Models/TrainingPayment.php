<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingPayment extends Model
{
    protected $table = "Training_Payment";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Name',
        'paid_amount',
        'Upload_Reciept',
        'training_id',
        'user_id'
    ];

    
}

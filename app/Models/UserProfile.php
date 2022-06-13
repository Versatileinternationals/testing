<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = "user_profile";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'est_date',
        'store_name',
        'banner',
        'description',
        'store_address',
        'store_city',
        'store_country',
        'store_pincode',
        'fax',
        'store_email',
        'website_url',
        'status'
    ];

    
}

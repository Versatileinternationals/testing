<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'user_id', 'street', 'city', 'state','country', 'zipcode'];
    protected $table = "user_address";

}

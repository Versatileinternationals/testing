<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoleAndPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     
     use Notifiable;
     
    protected $fillable = [
        'name',
        'last_name',
        'role_id',
        'user_type',
        'user_id',
        'email',
        'password',
        'phone',
        'phone_code',
        'address',
        'city',
        'state',
        'email_verified_at',
        'pincode',
        'country',
        'image',
        'status',
        'gender',        
        'provider',
        'provider_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function useraddress()
    {
        return $this->hasMany('App\Models\UserAddress', 'user_id', 'id');
    }
}

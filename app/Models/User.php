<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;
class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    //use HasRolesAndPermissions;
    protected $fillable = [
        'name',
        'email',
        'password'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

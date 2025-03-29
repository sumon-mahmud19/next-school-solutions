<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    protected $guard = 'admin';
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}

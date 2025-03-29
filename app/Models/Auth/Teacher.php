<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Teacher extends Authenticatable
{
    protected $guard = 'teacher';
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
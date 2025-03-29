<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;


class Student extends Authenticatable
{
    protected $guard = 'student';
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
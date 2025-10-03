<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Risnha extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['username', 'password'];

    protected $hidden = ['password'];
}

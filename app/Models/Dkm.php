<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dkm extends Model
{
    protected $table = 'dkms';

    protected $fillable = [
        'username',
        'password',
    ];
}

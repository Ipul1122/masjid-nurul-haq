<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TampilanHomeSection extends Model
{
    use HasFactory;

    protected $table = 'tampilan_home_sections';
    protected $fillable = ['image_path', 'order'];
}
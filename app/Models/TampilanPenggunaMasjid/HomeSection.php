<?php

// app/Models/TampilanPenggunaMasjid/HomeSection.php
namespace App\Models\TampilanPenggunaMasjid;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    use HasFactory;
    protected $fillable = ['image_path'];
}
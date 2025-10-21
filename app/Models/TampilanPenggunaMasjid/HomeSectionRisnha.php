<?php

namespace App\Models\TampilanPenggunaMasjid;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSectionRisnha extends Model
{
    use HasFactory;

    protected $table = 'home_section_risnhas';

    protected $fillable = [
        'gambar',
    ];
}
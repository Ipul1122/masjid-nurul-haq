<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Risnha;
use Illuminate\Support\Facades\Hash;

class RisnhaSeeder extends Seeder
{
    public function run(): void
    {
        Risnha::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
        ]);
    }
}

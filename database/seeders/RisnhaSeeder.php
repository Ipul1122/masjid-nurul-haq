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
            'username' => 'risnha',
            'password' => Hash::make('risnha123'),
        ]);
    }
}

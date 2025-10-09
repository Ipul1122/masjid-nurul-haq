<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dkm;
use Illuminate\Support\Facades\Hash;

class DkmSeeder extends Seeder
{
    public function run(): void
    {
        Dkm::create([
            'username' => 'dkm',
            'password' => Hash::make('dkm123'),
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'nik' => '1231234',
            'full_name' => 'panjol',
            'user' => 'panjol22',
            'password' => Hash::make('panjol22'),
        ]);
        User::create([
            'nik' => '12312345',
            'full_name' => 'wulan',
            'user' => 'wulan33',
            'password' => Hash::make('wulan33'),
        ]);
        User::create([
            'nik' => '123123456',
            'full_name' => 'witri',
            'user' => 'witri33',
            'password' => Hash::make('witri33'),
        ]);
    }
}

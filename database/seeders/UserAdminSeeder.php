<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()
            ->create([
                'name' => 'Admin',
                'role' => 'admin',
                'code' => 'A-' . now()->format('dmYHis'),
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin123'),
            ]);
    }
}

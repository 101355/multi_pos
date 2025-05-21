<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { {
            \App\Models\AdminUser::factory()->create([
                'name' => 'Admin',
                'phno' => '09123456789',
                'email' => 'admin@admin.com',
                'is_admin' => 1,
                'password' => Hash::make('admin'),
            ]);
        }
    }
}

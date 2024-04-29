<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'César Obed Figueroa Luna',
            'email' => 'cesar@test.com',
            'password' => Hash::make('12345678'),
            'phone' => '1122334455',
            'role' => 'admin'
        ]);
    }
}

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
            'email' => 'sistemas@carbono6.mx',
            'password' => Hash::make('secret'),
            'phone' => '3324533298',
            'role' => 'admin'
        ]);
    }
}

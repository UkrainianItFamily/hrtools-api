<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'phone' => '123456789012',
            'email' => 'test@example.com',
            'password' => '123123Aa',
        ]);
    }
}

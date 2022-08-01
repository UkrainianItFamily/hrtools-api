<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

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
            'password' => Hash::make('123123Aa'),
        ]);
    }
}

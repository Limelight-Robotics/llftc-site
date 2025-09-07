<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TeamSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Your Name',
            'email' => 'change@me.com',
            'password' => bcrypt('changeme'),
            'is_admin' => true,
        ]);
    }
}

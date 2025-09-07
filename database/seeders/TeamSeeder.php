<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = [
            'CAD',
            'Software',
            'Mechanical',
            'Documentation',
            'Outreach',
            'Marketing',
            'Uncategorized',
        ];

        foreach ($teams as $teamName) {
            Team::create(['name' => $teamName]);
        }
    }
}

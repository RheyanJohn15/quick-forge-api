<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Workspaces;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Rheyan',
            'email' => 'rheyanjohnblancogwapo@gmail.com',
        ]);

        $workspace = new Workspaces();
        $workspace->ws_name = "My Worspaces";
        $workspace->isDefault = true;
        $workspace->save();
    }
}

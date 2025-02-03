<?php

namespace Database\Seeders;

use App\Models\BusinessCategory;
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
        // User::factory(10)->create();

        User::factory()->createMany([
            [
                'name' => 'Hugo',
                'email' => 'hugo.ruiz.pz@gmail.com',
            ],
            [
                'name' => 'Test',
                'email' => 'ruiz@gmail.com',
            ]
        ]);

        BusinessCategory::insert([
            ["name" => "Barbería"],
            ["name" => "Salón de belleza"],
        ]);
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'email' => 'administrator@localhost',
            'password' => '$2y$10$K2IRpsgqRa1VNG/JoQWUiulSkvGCuGY8w5ZreRY.YXV.VrzI.60zO',
        ]);
    }
}

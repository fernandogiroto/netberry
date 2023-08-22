<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Study'],
            ['name' => 'Staff'],
            ['name' => 'Personal'],
            ['name' => 'Work'],
            ['name' => 'Travel'],
        ];

        DB::table('categories')->insert($categories);
    }
}

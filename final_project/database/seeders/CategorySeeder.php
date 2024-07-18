<?php

// CategorySeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            [
                'category_id' => Str::uuid(),
                'name' => 'Construction toys',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => Str::uuid(),
                'name' => 'Creative toys',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => Str::uuid(),
                'name' => 'Dolls',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => Str::uuid(),
                'name' => 'Food-related toys',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => Str::uuid(),
                'name' => 'Games',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => Str::uuid(),
                'name' => 'Puzzle/assembly',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

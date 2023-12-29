<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Programming',
            'slug' => 'programming',
        ]);

        Category::create([
            'name' => 'Sains',
            'slug' => 'sains',
        ]);

        Category::create([
            'name' => 'Ekonomi',
            'slug' => 'ekonomi',
        ]);

        Category::create([
            'name' => 'Sejarah',
            'slug' => 'sejarah',
        ]);

        Category::create([
            'name' => 'Arsitektur',
            'slug' => 'arsitektur',
        ]);

        Category::create([
            'name' => 'Politik',
            'slug' => 'politik',
        ]);
    }
}

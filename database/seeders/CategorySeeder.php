<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'description' => 'Programming, software development, and tech skills',
                'color' => '#3B82F6',
            ],
            [
                'name' => 'Music',
                'description' => 'Musical instruments, singing, and music production',
                'color' => '#8B5CF6',
            ],
            [
                'name' => 'Languages',
                'description' => 'Foreign languages and communication skills',
                'color' => '#10B981',
            ],
            [
                'name' => 'Arts & Crafts',
                'description' => 'Drawing, painting, crafting, and creative arts',
                'color' => '#F59E0B',
            ],
            [
                'name' => 'Sports & Fitness',
                'description' => 'Physical activities, sports, and fitness training',
                'color' => '#EF4444',
            ],
            [
                'name' => 'Cooking',
                'description' => 'Culinary skills, baking, and food preparation',
                'color' => '#EC4899',
            ],
            [
                'name' => 'Business',
                'description' => 'Business skills, marketing, and entrepreneurship',
                'color' => '#6366F1',
            ],
            [
                'name' => 'Photography',
                'description' => 'Photography, videography, and visual media',
                'color' => '#14B8A6',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Tes Potensi Skolastik',
                'code' => 'TPS',
                'description' => 'Mengukur kemampuan kognitif yang dianggap penting untuk keberhasilan di sekolah',
                'icon' => 'brain',
                'color' => '#3B82F6',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Literasi Bahasa Indonesia',
                'code' => 'LBI',
                'description' => 'Kemampuan memahami dan menggunakan Bahasa Indonesia',
                'icon' => 'book-open',
                'color' => '#10B981',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Literasi Bahasa Inggris',
                'code' => 'LBIng',
                'description' => 'Kemampuan memahami dan menggunakan Bahasa Inggris',
                'icon' => 'globe',
                'color' => '#8B5CF6',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Penalaran Matematika',
                'code' => 'PM',
                'description' => 'Kemampuan berpikir menggunakan konsep matematika',
                'icon' => 'calculator',
                'color' => '#F59E0B',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Fisika',
                'code' => 'FIS',
                'description' => 'Pengetahuan dan penerapan konsep fisika',
                'icon' => 'atom',
                'color' => '#EF4444',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Kimia',
                'code' => 'KIM',
                'description' => 'Pengetahuan dan penerapan konsep kimia',
                'icon' => 'flask',
                'color' => '#06B6D4',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Biologi',
                'code' => 'BIO',
                'description' => 'Pengetahuan dan penerapan konsep biologi',
                'icon' => 'microscope',
                'color' => '#84CC16',
                'order' => 7,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
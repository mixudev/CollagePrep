<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $tps = Category::where('code', 'TPS')->first();
        $pm = Category::where('code', 'PM')->first();
        $fis = Category::where('code', 'FIS')->first();

        Module::create([
            'category_id' => $tps->id,
            'title' => 'Tryout UTBK 2024 - Paket 1',
            'code' => 'TO-TPS-001',
            'description' => 'Tryout lengkap Tes Potensi Skolastik paket pertama',
            'duration' => 90,
            'total_questions' => 0, // Will be auto-calculated
            'passing_grade' => 60,
            'start_date' => now(),
            'end_date' => now()->addMonths(3),
            'is_published' => true,
            'show_ranking' => true,
            'show_answer_after_submit' => true,
            'max_attempts' => 3,
        ]);

        Module::create([
            'category_id' => $pm->id,
            'title' => 'Tryout Penalaran Matematika - Basic',
            'code' => 'TO-PM-001',
            'description' => 'Latihan dasar penalaran matematika UTBK',
            'duration' => 60,
            'total_questions' => 0, // Will be auto-calculated
            'passing_grade' => 70,
            'start_date' => now(),
            'end_date' => now()->addMonths(3),
            'is_published' => true,
            'show_ranking' => true,
            'show_answer_after_submit' => false,
            'max_attempts' => 2,
        ]);

        Module::create([
            'category_id' => $fis->id,
            'title' => 'Tryout Fisika - Mekanika',
            'code' => 'TO-FIS-001',
            'description' => 'Fokus pada materi mekanika dan kinematika',
            'duration' => 45,
            'total_questions' => 0, // Will be auto-calculated
            'passing_grade' => 65,
            'start_date' => now(),
            'end_date' => now()->addMonths(2),
            'is_published' => true,
            'show_ranking' => true,
            'show_answer_after_submit' => true,
            'max_attempts' => 1,
        ]);
    }
}
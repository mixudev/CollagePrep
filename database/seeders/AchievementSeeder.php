<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        $achievements = [
            [
                'name' => 'First Step',
                'code' => 'FIRST_STEP',
                'description' => 'Selesaikan tryout pertama kamu',
                'icon' => 'trophy',
                'badge_color' => '#FCD34D',
                'type' => 'completion',
                'requirement_value' => 1,
                'points' => 10,
                'is_active' => true,
            ],
            [
                'name' => 'Perfect Score',
                'code' => 'PERFECT_SCORE',
                'description' => 'Dapatkan nilai 100 di sebuah tryout',
                'icon' => 'star',
                'badge_color' => '#F59E0B',
                'type' => 'score',
                'requirement_value' => 100,
                'points' => 50,
                'is_active' => true,
            ],
            [
                'name' => 'Speed Runner',
                'code' => 'SPEED_RUNNER',
                'description' => 'Selesaikan tryout dalam waktu kurang dari 50% durasi',
                'icon' => 'zap',
                'badge_color' => '#3B82F6',
                'type' => 'speed',
                'requirement_value' => 50,
                'points' => 30,
                'is_active' => true,
            ],
            [
                'name' => 'Consistent Learner',
                'code' => 'CONSISTENT_7',
                'description' => 'Belajar selama 7 hari berturut-turut',
                'icon' => 'calendar',
                'badge_color' => '#10B981',
                'type' => 'streak',
                'requirement_value' => 7,
                'points' => 25,
                'is_active' => true,
            ],
            [
                'name' => 'Sharp Shooter',
                'code' => 'ACCURACY_90',
                'description' => 'Capai akurasi 90% atau lebih',
                'icon' => 'target',
                'badge_color' => '#EF4444',
                'type' => 'accuracy',
                'requirement_value' => 90,
                'points' => 40,
                'is_active' => true,
            ],
        ];

        foreach ($achievements as $achievement) {
            Achievement::create($achievement);
        }
    }
}
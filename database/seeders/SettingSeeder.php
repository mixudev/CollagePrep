<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General Settings
            [
                'key' => 'site_name',
                'value' => 'Tryout UTBK Platform',
                'type' => 'text',
                'group' => 'general',
                'description' => 'Nama aplikasi',
            ],
            [
                'key' => 'site_description',
                'value' => 'Platform tryout online untuk persiapan UTBK/SBMPTN',
                'type' => 'text',
                'group' => 'general',
                'description' => 'Deskripsi singkat aplikasi',
            ],
            [
                'key' => 'site_icon',
                'value' => '',
                'type' => 'file',
                'group' => 'general',
                'description' => 'Icon aplikasi (logo/favicon)',
            ],
            [
                'key' => 'registration_enabled',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'general',
                'description' => 'Aktifkan/nonaktifkan registrasi user baru',
            ],
            [
                'key' => 'primary_color',
                'value' => '#111827',
                'type' => 'color',
                'group' => 'appearance',
                'description' => 'Warna utama aplikasi',
            ],
            [
                'key' => 'secondary_color',
                'value' => '#f97316',
                'type' => 'color',
                'group' => 'appearance',
                'description' => 'Warna pendukung aplikasi',
            ],
            
            // Exam Settings
            [
                'key' => 'show_timer',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'exam',
                'description' => 'Tampilkan timer saat mengerjakan',
            ],
            [
                'key' => 'auto_submit',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'exam',
                'description' => 'Auto submit saat waktu habis',
            ],
            [
                'key' => 'allow_review',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'exam',
                'description' => 'Izinkan review jawaban sebelum submit',
            ],
            
            // Ranking Settings
            [
                'key' => 'public_ranking',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'ranking',
                'description' => 'Tampilkan ranking ke semua user',
            ],
            [
                'key' => 'ranking_update_interval',
                'value' => '5',
                'type' => 'number',
                'group' => 'ranking',
                'description' => 'Interval update ranking (menit)',
            ],
            
            // Point System
            [
                'key' => 'points_per_correct',
                'value' => '5',
                'type' => 'number',
                'group' => 'points',
                'description' => 'Poin per jawaban benar',
            ],
            [
                'key' => 'penalty_wrong_answer',
                'value' => '0',
                'type' => 'number',
                'group' => 'points',
                'description' => 'Pengurangan poin untuk jawaban salah',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
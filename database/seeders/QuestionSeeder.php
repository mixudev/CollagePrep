<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $modules = Module::all();

        foreach ($modules as $module) {
            $this->createQuestionsForModule($module);
            
            // Update total_questions
            $module->update([
                'total_questions' => $module->questions()->count()
            ]);
        }
    }

    private function createQuestionsForModule(Module $module)
    {
        $categoryCode = $module->category->code ?? 'GEN';
        $questionTexts = $this->getQuestionTexts($categoryCode);
        
        // Create at least 10 questions per module
        $questionCount = max(10, count($questionTexts));
        
        for ($i = 1; $i <= $questionCount; $i++) {
            $questionData = $questionTexts[$i - 1] ?? $this->getDefaultQuestion($i, $categoryCode);
            
            // Alternate between multiple_choice and true_false
            $type = ($i % 3 === 0) ? 'true_false' : 'multiple_choice';
            
            $question = Question::create([
                'module_id' => $module->id,
                'category_id' => $module->category_id,
                'question_text' => $questionData['text'],
                'type' => $type,
                'points' => $questionData['points'] ?? 5,
                'difficulty' => $questionData['difficulty'] ?? $this->getRandomDifficulty(),
                'explanation' => $questionData['explanation'] ?? null,
                'order' => $i,
                'is_active' => true,
            ]);

            if ($type === 'multiple_choice') {
                $this->createMultipleChoiceOptions($question, $questionData);
            } else {
                $this->createTrueFalseOptions($question, $questionData);
            }
        }
    }

    private function createMultipleChoiceOptions(Question $question, array $questionData)
    {
        $options = $questionData['options'] ?? $this->getDefaultOptions();
        $correctIndex = $questionData['correct_index'] ?? 0;

        foreach ($options as $index => $optionText) {
            QuestionOption::create([
                'question_id' => $question->id,
                'option_label' => chr(65 + $index), // A, B, C, D, E
                'option_text' => $optionText,
                'is_correct' => $index === $correctIndex,
                'order' => $index + 1,
            ]);
        }
    }

    private function createTrueFalseOptions(Question $question, array $questionData)
    {
        $isTrue = $questionData['is_true'] ?? (rand(0, 1) === 1);
        
        QuestionOption::create([
            'question_id' => $question->id,
            'option_label' => 'A',
            'option_text' => 'Benar',
            'is_correct' => $isTrue,
            'order' => 1,
        ]);

        QuestionOption::create([
            'question_id' => $question->id,
            'option_label' => 'B',
            'option_text' => 'Salah',
            'is_correct' => !$isTrue,
            'order' => 2,
        ]);
    }

    private function getQuestionTexts(string $categoryCode): array
    {
        $questions = [
            'TPS' => [
                [
                    'text' => 'Jika semua A adalah B, dan semua B adalah C, maka...',
                    'options' => ['Semua A adalah C', 'Semua C adalah A', 'Tidak ada hubungan antara A dan C', 'Semua B adalah A', 'Beberapa A adalah C'],
                    'correct_index' => 0,
                    'points' => 5,
                    'difficulty' => 'easy',
                    'explanation' => 'Ini adalah silogisme sederhana. Jika A⊆B dan B⊆C maka A⊆C',
                ],
                [
                    'text' => 'Deret angka: 2, 6, 12, 20, ... Angka selanjutnya adalah?',
                    'options' => ['28', '30', '32', '34', '36'],
                    'correct_index' => 1,
                    'points' => 5,
                    'difficulty' => 'medium',
                    'explanation' => 'Pola: n(n+1), dimana n=1,2,3,4,5... Jawaban: 5×6 = 30',
                ],
                [
                    'text' => 'Dalam suatu kelas, 60% siswa suka matematika dan 40% suka fisika. Jika 30% suka keduanya, berapa persen yang tidak suka keduanya?',
                    'options' => ['10%', '20%', '30%', '40%', '50%'],
                    'correct_index' => 2,
                    'points' => 5,
                    'difficulty' => 'medium',
                    'explanation' => 'Gunakan diagram Venn: 60% + 40% - 30% = 70% suka salah satu atau keduanya. Jadi 30% tidak suka keduanya.',
                ],
                [
                    'text' => 'Jika x + y = 10 dan x - y = 4, maka nilai x adalah?',
                    'options' => ['5', '6', '7', '8', '9'],
                    'correct_index' => 2,
                    'points' => 5,
                    'difficulty' => 'easy',
                    'explanation' => 'Dari x + y = 10 dan x - y = 4, tambahkan: 2x = 14, jadi x = 7',
                ],
                [
                    'text' => 'Semua bilangan prima adalah ganjil.',
                    'is_true' => false,
                    'points' => 5,
                    'difficulty' => 'easy',
                    'explanation' => 'Salah, karena 2 adalah bilangan prima yang genap.',
                ],
                [
                    'text' => 'Jika p = 5 dan q = 3, maka p² - q² = 16.',
                    'is_true' => true,
                    'points' => 5,
                    'difficulty' => 'easy',
                    'explanation' => 'Benar, karena 5² - 3² = 25 - 9 = 16',
                ],
                [
                    'text' => 'Persegi panjang dengan panjang 8 cm dan lebar 6 cm memiliki luas 48 cm².',
                    'is_true' => true,
                    'points' => 5,
                    'difficulty' => 'easy',
                    'explanation' => 'Benar, luas = panjang × lebar = 8 × 6 = 48 cm²',
                ],
                [
                    'text' => 'Semua segitiga sama sisi memiliki sudut 60 derajat.',
                    'is_true' => true,
                    'points' => 5,
                    'difficulty' => 'medium',
                    'explanation' => 'Benar, dalam segitiga sama sisi, semua sudut sama besar yaitu 60°',
                ],
                [
                    'text' => 'Jika a > b dan b > c, maka a > c. Pernyataan ini selalu benar.',
                    'is_true' => true,
                    'points' => 5,
                    'difficulty' => 'easy',
                    'explanation' => 'Benar, ini adalah sifat transitif dari ketidaksamaan.',
                ],
                [
                    'text' => 'Jumlah sudut dalam segitiga adalah 180 derajat.',
                    'is_true' => true,
                    'points' => 5,
                    'difficulty' => 'easy',
                    'explanation' => 'Benar, ini adalah teorema dasar dalam geometri.',
                ],
            ],
            'PM' => [
                [
                    'text' => 'Jika 2x + 3 = 11, maka nilai x adalah?',
                    'options' => ['3', '4', '5', '6', '7'],
                    'correct_index' => 1,
                    'points' => 5,
                    'difficulty' => 'easy',
                    'explanation' => '2x = 11 - 3 = 8, jadi x = 4',
                ],
                [
                    'text' => 'Luas lingkaran dengan jari-jari 7 cm adalah? (π = 22/7)',
                    'options' => ['44 cm²', '88 cm²', '154 cm²', '176 cm²', '308 cm²'],
                    'correct_index' => 2,
                    'points' => 5,
                    'difficulty' => 'medium',
                    'explanation' => 'Luas = πr² = (22/7) × 7² = 22 × 7 = 154 cm²',
                ],
                [
                    'text' => 'Jika f(x) = 2x + 1, maka f(3) = 7.',
                    'is_true' => true,
                    'points' => 5,
                    'difficulty' => 'easy',
                    'explanation' => 'Benar, f(3) = 2(3) + 1 = 6 + 1 = 7',
                ],
                [
                    'text' => 'Deret aritmatika: 5, 9, 13, 17, ... Suku ke-10 adalah?',
                    'options' => ['37', '39', '41', '43', '45'],
                    'correct_index' => 2,
                    'points' => 5,
                    'difficulty' => 'medium',
                    'explanation' => 'a = 5, b = 4. U₁₀ = a + (n-1)b = 5 + 9(4) = 5 + 36 = 41',
                ],
                [
                    'text' => 'Semua bilangan genap habis dibagi 2.',
                    'is_true' => true,
                    'points' => 5,
                    'difficulty' => 'easy',
                    'explanation' => 'Benar, definisi bilangan genap adalah bilangan yang habis dibagi 2.',
                ],
                [
                    'text' => 'Jika log₁₀ 100 = x, maka x = 2.',
                    'is_true' => true,
                    'points' => 5,
                    'difficulty' => 'medium',
                    'explanation' => 'Benar, karena 10² = 100, jadi log₁₀ 100 = 2',
                ],
                [
                    'text' => 'Volume kubus dengan sisi 5 cm adalah 125 cm³.',
                    'is_true' => true,
                    'points' => 5,
                    'difficulty' => 'easy',
                    'explanation' => 'Benar, volume = s³ = 5³ = 125 cm³',
                ],
                [
                    'text' => 'Jika x² = 16, maka x = 4 atau x = -4.',
                    'is_true' => true,
                    'points' => 5,
                    'difficulty' => 'medium',
                    'explanation' => 'Benar, karena 4² = 16 dan (-4)² = 16',
                ],
                [
                    'text' => 'Persamaan garis yang melalui titik (0,3) dan (2,7) adalah y = 2x + 3.',
                    'is_true' => true,
                    'points' => 5,
                    'difficulty' => 'medium',
                    'explanation' => 'Benar, gradien = (7-3)/(2-0) = 2, dan melalui (0,3) jadi y = 2x + 3',
                ],
                [
                    'text' => 'Faktorial dari 5 adalah 120.',
                    'is_true' => true,
                    'points' => 5,
                    'difficulty' => 'easy',
                    'explanation' => 'Benar, 5! = 5 × 4 × 3 × 2 × 1 = 120',
                ],
            ],
            'FIS' => [
                [
                    'text' => 'Kecepatan adalah besaran vektor.',
                    'is_true' => true,
                    'points' => 5,
                    'difficulty' => 'easy',
                    'explanation' => 'Benar, kecepatan memiliki besar dan arah, sehingga termasuk besaran vektor.',
                ],
                [
                    'text' => 'Jika benda bergerak dengan kecepatan konstan, maka percepatannya nol.',
                    'is_true' => true,
                    'points' => 5,
                    'difficulty' => 'medium',
                    'explanation' => 'Benar, percepatan adalah perubahan kecepatan per satuan waktu. Jika kecepatan konstan, percepatan = 0.',
                ],
                [
                    'text' => 'Hukum Newton pertama menyatakan bahwa F = ma.',
                    'is_true' => false,
                    'points' => 5,
                    'difficulty' => 'medium',
                    'explanation' => 'Salah, F = ma adalah Hukum Newton kedua. Hukum pertama menyatakan tentang inersia.',
                ],
                [
                    'text' => 'Energi kinetik benda dengan massa 2 kg dan kecepatan 5 m/s adalah?',
                    'options' => ['10 J', '20 J', '25 J', '50 J', '100 J'],
                    'correct_index' => 2,
                    'points' => 5,
                    'difficulty' => 'medium',
                    'explanation' => 'EK = ½mv² = ½ × 2 × 5² = ½ × 2 × 25 = 25 J',
                ],
                [
                    'text' => 'Gaya gravitasi di permukaan bumi selalu mengarah ke bawah.',
                    'is_true' => true,
                    'points' => 5,
                    'difficulty' => 'easy',
                    'explanation' => 'Benar, gaya gravitasi selalu mengarah ke pusat bumi (ke bawah).',
                ],
                [
                    'text' => 'Massa dan berat adalah besaran yang sama.',
                    'is_true' => false,
                    'points' => 5,
                    'difficulty' => 'easy',
                    'explanation' => 'Salah, massa adalah jumlah materi (skalar), sedangkan berat adalah gaya (vektor).',
                ],
                [
                    'text' => 'Jika benda jatuh bebas, percepatannya adalah 9,8 m/s².',
                    'is_true' => true,
                    'points' => 5,
                    'difficulty' => 'easy',
                    'explanation' => 'Benar, percepatan gravitasi di permukaan bumi adalah sekitar 9,8 m/s².',
                ],
                [
                    'text' => 'Momentum adalah hasil kali massa dan kecepatan.',
                    'is_true' => true,
                    'points' => 5,
                    'difficulty' => 'medium',
                    'explanation' => 'Benar, p = mv, dimana p adalah momentum, m adalah massa, dan v adalah kecepatan.',
                ],
                [
                    'text' => 'Usaha yang dilakukan gaya 10 N untuk memindahkan benda sejauh 5 m adalah?',
                    'options' => ['15 J', '25 J', '50 J', '75 J', '100 J'],
                    'correct_index' => 2,
                    'points' => 5,
                    'difficulty' => 'easy',
                    'explanation' => 'W = F × s = 10 × 5 = 50 J',
                ],
                [
                    'text' => 'Hukum kekekalan energi mekanik berlaku jika tidak ada gaya non-konservatif.',
                    'is_true' => true,
                    'points' => 5,
                    'difficulty' => 'hard',
                    'explanation' => 'Benar, hukum kekekalan energi mekanik berlaku jika hanya ada gaya konservatif.',
                ],
            ],
        ];

        return $questions[$categoryCode] ?? [];
    }

    private function getDefaultQuestion(int $index, string $categoryCode): array
    {
        $type = ($index % 3 === 0) ? 'true_false' : 'multiple_choice';
        
        if ($type === 'true_false') {
            return [
                'text' => "Pernyataan soal nomor {$index} untuk kategori {$categoryCode}. Pilih benar atau salah.",
                'is_true' => rand(0, 1) === 1,
                'points' => 5,
                'difficulty' => $this->getRandomDifficulty(),
            ];
        } else {
            return [
                'text' => "Soal nomor {$index} untuk kategori {$categoryCode}. Pilih jawaban yang paling tepat.",
                'options' => $this->getDefaultOptions(),
                'correct_index' => 0,
                'points' => 5,
                'difficulty' => $this->getRandomDifficulty(),
            ];
        }
    }

    private function getDefaultOptions(): array
    {
        return [
            'Pilihan A',
            'Pilihan B',
            'Pilihan C',
            'Pilihan D',
            'Pilihan E',
        ];
    }

    private function getRandomDifficulty(): string
    {
        $difficulties = ['easy', 'medium', 'hard'];
        return $difficulties[array_rand($difficulties)];
    }
}

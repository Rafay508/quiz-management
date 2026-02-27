<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class QuizTableSeeder extends Seeder
{
    public function run()
    {
        $adminId = 1; // replace with a valid admin id

        $categories = [
            [
                'name' => 'General Knowledge',
                'description' => 'General knowledge and facts.',
                'quiz_level' => 'Beginner',
            ],
            [
                'name' => 'Programming & Technology',
                'description' => 'Questions about programming and tech.',
                'quiz_level' => 'Intermediate',
            ],
            [
                'name' => 'Current Affairs',
                'description' => 'Latest news and current world events.',
                'quiz_level' => 'Intermediate',
            ],
            [
                'name' => 'Science & Nature',
                'description' => 'Physics, Chemistry, Biology, and Environment.',
                'quiz_level' => 'Beginner',
            ],
            [
                'name' => 'Mathematics & IQ',
                'description' => 'Math problems and logical reasoning.',
                'quiz_level' => 'Advanced',
            ],
        ];

        foreach ($categories as $catIndex => $catData) {
            $categoryId = DB::table('categories')->insertGetId([
                'name' => $catData['name'],
                'description' => $catData['description'],
                'status' => 'active',
                'created_by' => $adminId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create a quiz for each category
            $quizTitle = $catData['name'] . ' Quiz';
            $quizId = DB::table('quizzes')->insertGetId([
                'title' => $quizTitle,
                'description' => 'A quiz on ' . strtolower($catData['name']),
                'category_id' => $categoryId,
                'level' => $catData['quiz_level'],
                'duration_minutes' => 30,
                'total_marks' => 10 * 1, // 10 questions, 1 mark each
                'pass_marks' => 5,
                'expiry_date' => Carbon::now()->addMonths(6),
                'is_published' => true,
                'created_by' => $adminId,
                'instructions' => 'Answer all questions carefully.',
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create 10 questions per quiz
            for ($q = 1; $q <= 10; $q++) {
                $difficultyLevels = ['easy', 'medium', 'hard'];
                $difficulty = $difficultyLevels[array_rand($difficultyLevels)];

                $questionId = DB::table('questions')->insertGetId([
                    'quiz_id' => $quizId,
                    'question_text' => $this->generateQuestion($catIndex, $q),
                    'question_type' => 'mcq',
                    'difficulty_level' => $difficulty,
                    'marks' => 1,
                    'negative_marks' => 0,
                    'order_position' => $q,
                    'explanation' => 'This is the correct answer explanation.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Create 4 options per question
                $options = $this->generateOptions($catIndex, $q);
                foreach ($options as $order => $option) {
                    DB::table('question_options')->insert([
                        'question_id' => $questionId,
                        'option_text' => $option['text'],
                        'is_correct' => $option['is_correct'],
                        'order_position' => $order + 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    private function generateQuestion($categoryIndex, $qIndex)
    {
        $questions = [
            // General Knowledge
            [
                'What is the capital of France?',
                'Who wrote "Romeo and Juliet"?',
                'Which planet is known as the Red Planet?',
                'What is the currency of Japan?',
                'Who invented the telephone?',
                'Which ocean is the largest?',
                'Which year did World War II end?',
                'Who painted the Mona Lisa?',
                'What is the tallest mountain in the world?',
                'What language has the most native speakers?',
            ],
            // Programming & Technology
            [
                'What does HTML stand for?',
                'What is the latest PHP version?',
                'Which language is primarily used for Android development?',
                'What is Laravel in PHP?',
                'What is Git used for?',
                'What is a loop in programming?',
                'Which company created Python?',
                'What is an API?',
                'What is frontend development?',
                'What does CSS stand for?',
            ],
            // Current Affairs
            [
                'Who is the current Secretary-General of the UN (2025)?',
                'Which country hosted the 2024 Olympics?',
                'Who won the 2024 Nobel Peace Prize?',
                'Which country recently launched James Webb Space Telescope mission?',
                'Who is the current US President (2025)?',
                'Which tech company acquired another company in 2024?',
                'What is the global inflation rate in 2025 (approx)?',
                'Which country legalized AI-assisted surgeries recently?',
                'Which movie won the Oscar for Best Picture 2025?',
                'Which nation recently signed climate change agreements?',
            ],
            // Science & Nature
            [
                'What is the chemical symbol for water?',
                'Who developed the theory of relativity?',
                'What planet is closest to the Sun?',
                'Which gas do humans inhale to survive?',
                'What is the speed of light?',
                'Which element has the atomic number 1?',
                'What is photosynthesis?',
                'What organ pumps blood in humans?',
                'Which organelle is called the powerhouse of the cell?',
                'Which planet has rings around it?',
            ],
            // Mathematics & IQ
            [
                'What is 12 x 12?',
                'What is the square root of 144?',
                'Solve: 2 + 2 x 3 = ?',
                'What comes next in the series: 2, 4, 8, 16, ?',
                'If a train travels 60km/h for 2 hours, how far does it go?',
                'What is 15% of 200?',
                'Which number is prime: 21, 29, 35, 49?',
                'What is the next prime number after 7?',
                'Solve: 5 + 3 x (2 + 1) = ?',
                'If x + 3 = 10, what is x?',
            ],
        ];

        return $questions[$categoryIndex][$qIndex - 1];
    }

    private function generateOptions($categoryIndex, $qIndex)
    {
        // Example options, correct answer is always first
        $options = [
            // General Knowledge
            [
                ['text' => 'Paris', 'is_correct' => true],
                ['text' => 'London', 'is_correct' => false],
                ['text' => 'Rome', 'is_correct' => false],
                ['text' => 'Berlin', 'is_correct' => false],
            ],
            [
                ['text' => 'William Shakespeare', 'is_correct' => true],
                ['text' => 'Charles Dickens', 'is_correct' => false],
                ['text' => 'Mark Twain', 'is_correct' => false],
                ['text' => 'Jane Austen', 'is_correct' => false],
            ],
            [
                ['text' => 'Mars', 'is_correct' => true],
                ['text' => 'Earth', 'is_correct' => false],
                ['text' => 'Jupiter', 'is_correct' => false],
                ['text' => 'Venus', 'is_correct' => false],
            ],
            [
                ['text' => 'Yen', 'is_correct' => true],
                ['text' => 'Dollar', 'is_correct' => false],
                ['text' => 'Euro', 'is_correct' => false],
                ['text' => 'Pound', 'is_correct' => false],
            ],
            [
                ['text' => 'Alexander Graham Bell', 'is_correct' => true],
                ['text' => 'Thomas Edison', 'is_correct' => false],
                ['text' => 'Nikola Tesla', 'is_correct' => false],
                ['text' => 'Isaac Newton', 'is_correct' => false],
            ],
            [
                ['text' => 'Pacific', 'is_correct' => true],
                ['text' => 'Atlantic', 'is_correct' => false],
                ['text' => 'Indian', 'is_correct' => false],
                ['text' => 'Arctic', 'is_correct' => false],
            ],
            [
                ['text' => '1945', 'is_correct' => true],
                ['text' => '1939', 'is_correct' => false],
                ['text' => '1918', 'is_correct' => false],
                ['text' => '1950', 'is_correct' => false],
            ],
            [
                ['text' => 'Leonardo da Vinci', 'is_correct' => true],
                ['text' => 'Vincent van Gogh', 'is_correct' => false],
                ['text' => 'Pablo Picasso', 'is_correct' => false],
                ['text' => 'Claude Monet', 'is_correct' => false],
            ],
            [
                ['text' => 'Mount Everest', 'is_correct' => true],
                ['text' => 'K2', 'is_correct' => false],
                ['text' => 'Kangchenjunga', 'is_correct' => false],
                ['text' => 'Lhotse', 'is_correct' => false],
            ],
            [
                ['text' => 'Mandarin', 'is_correct' => true],
                ['text' => 'English', 'is_correct' => false],
                ['text' => 'Spanish', 'is_correct' => false],
                ['text' => 'Hindi', 'is_correct' => false],
            ],
        ];

        return $options[$qIndex - 1];
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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

        $bank = $this->questionBank();

        foreach ($categories as $catIndex => $catData) {
            // Safety: ensure we have 10 questions for this category
            if (!isset($bank[$catIndex]) || count($bank[$catIndex]) < 10) {
                throw new \RuntimeException("Question bank missing or incomplete for category index: {$catIndex}");
            }

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
                'total_marks' => 10, // 10 questions, 1 mark each
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

                $questionText = $bank[$catIndex][$q - 1]['text'];
                $options = $bank[$catIndex][$q - 1]['options'];
                $explanation = $bank[$catIndex][$q - 1]['explanation'] ?? 'This is the correct answer explanation.';

                // Optional: shuffle options so correct answer is not always first
                $options = $this->shuffleOptionsPreserveCorrect($options);

                $questionId = DB::table('questions')->insertGetId([
                    'quiz_id' => $quizId,
                    'question_text' => $questionText,
                    'question_type' => 'mcq',
                    'difficulty_level' => $difficulty,
                    'marks' => 1,
                    'negative_marks' => 0,
                    'order_position' => $q,
                    'explanation' => $explanation,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Insert 4 options per question
                foreach ($options as $order => $option) {
                    DB::table('question_options')->insert([
                        'question_id' => $questionId,
                        'option_text' => $option['text'],
                        'is_correct' => (bool) $option['is_correct'],
                        'order_position' => $order + 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    /**
     * Complete question bank: 5 categories x 10 questions each, with mapped options.
     */
    private function questionBank(): array
    {
        return [
            // 0) General Knowledge
            [
                [
                    'text' => 'What is the capital of France?',
                    'options' => [
                        ['text' => 'Paris', 'is_correct' => true],
                        ['text' => 'London', 'is_correct' => false],
                        ['text' => 'Rome', 'is_correct' => false],
                        ['text' => 'Berlin', 'is_correct' => false],
                    ],
                    'explanation' => 'Paris is the capital city of France.',
                ],
                [
                    'text' => 'Who wrote "Romeo and Juliet"?',
                    'options' => [
                        ['text' => 'William Shakespeare', 'is_correct' => true],
                        ['text' => 'Charles Dickens', 'is_correct' => false],
                        ['text' => 'Mark Twain', 'is_correct' => false],
                        ['text' => 'Jane Austen', 'is_correct' => false],
                    ],
                    'explanation' => 'Shakespeare wrote Romeo and Juliet.',
                ],
                [
                    'text' => 'Which planet is known as the Red Planet?',
                    'options' => [
                        ['text' => 'Mars', 'is_correct' => true],
                        ['text' => 'Earth', 'is_correct' => false],
                        ['text' => 'Jupiter', 'is_correct' => false],
                        ['text' => 'Venus', 'is_correct' => false],
                    ],
                    'explanation' => 'Mars appears reddish due to iron oxide on its surface.',
                ],
                [
                    'text' => 'What is the currency of Japan?',
                    'options' => [
                        ['text' => 'Yen', 'is_correct' => true],
                        ['text' => 'Dollar', 'is_correct' => false],
                        ['text' => 'Euro', 'is_correct' => false],
                        ['text' => 'Pound', 'is_correct' => false],
                    ],
                    'explanation' => 'Japan uses the Yen (JPY).',
                ],
                [
                    'text' => 'Who invented the telephone?',
                    'options' => [
                        ['text' => 'Alexander Graham Bell', 'is_correct' => true],
                        ['text' => 'Thomas Edison', 'is_correct' => false],
                        ['text' => 'Nikola Tesla', 'is_correct' => false],
                        ['text' => 'Isaac Newton', 'is_correct' => false],
                    ],
                    'explanation' => 'Alexander Graham Bell is credited with inventing the telephone.',
                ],
                [
                    'text' => 'Which ocean is the largest?',
                    'options' => [
                        ['text' => 'Pacific Ocean', 'is_correct' => true],
                        ['text' => 'Atlantic Ocean', 'is_correct' => false],
                        ['text' => 'Indian Ocean', 'is_correct' => false],
                        ['text' => 'Arctic Ocean', 'is_correct' => false],
                    ],
                    'explanation' => 'The Pacific Ocean is the largest ocean on Earth.',
                ],
                [
                    'text' => 'Which year did World War II end?',
                    'options' => [
                        ['text' => '1945', 'is_correct' => true],
                        ['text' => '1939', 'is_correct' => false],
                        ['text' => '1918', 'is_correct' => false],
                        ['text' => '1950', 'is_correct' => false],
                    ],
                    'explanation' => 'World War II ended in 1945.',
                ],
                [
                    'text' => 'Who painted the Mona Lisa?',
                    'options' => [
                        ['text' => 'Leonardo da Vinci', 'is_correct' => true],
                        ['text' => 'Vincent van Gogh', 'is_correct' => false],
                        ['text' => 'Pablo Picasso', 'is_correct' => false],
                        ['text' => 'Claude Monet', 'is_correct' => false],
                    ],
                    'explanation' => 'The Mona Lisa was painted by Leonardo da Vinci.',
                ],
                [
                    'text' => 'What is the tallest mountain in the world (above sea level)?',
                    'options' => [
                        ['text' => 'Mount Everest', 'is_correct' => true],
                        ['text' => 'K2', 'is_correct' => false],
                        ['text' => 'Kangchenjunga', 'is_correct' => false],
                        ['text' => 'Lhotse', 'is_correct' => false],
                    ],
                    'explanation' => 'Mount Everest is the tallest above sea level.',
                ],
                [
                    'text' => 'Which language has the most native speakers worldwide?',
                    'options' => [
                        ['text' => 'Mandarin Chinese', 'is_correct' => true],
                        ['text' => 'English', 'is_correct' => false],
                        ['text' => 'Spanish', 'is_correct' => false],
                        ['text' => 'Hindi', 'is_correct' => false],
                    ],
                    'explanation' => 'Mandarin Chinese has the most native speakers.',
                ],
            ],

            // 1) Programming & Technology
            [
                [
                    'text' => 'What does HTML stand for?',
                    'options' => [
                        ['text' => 'HyperText Markup Language', 'is_correct' => true],
                        ['text' => 'HighText Machine Language', 'is_correct' => false],
                        ['text' => 'Hyperlinks and Text Marking Language', 'is_correct' => false],
                        ['text' => 'Home Tool Markup Language', 'is_correct' => false],
                    ],
                    'explanation' => 'HTML stands for HyperText Markup Language.',
                ],
                [
                    'text' => 'Which of these is a version control system?',
                    'options' => [
                        ['text' => 'Git', 'is_correct' => true],
                        ['text' => 'HTTP', 'is_correct' => false],
                        ['text' => 'CSS', 'is_correct' => false],
                        ['text' => 'JSON', 'is_correct' => false],
                    ],
                    'explanation' => 'Git is used for version control.',
                ],
                [
                    'text' => 'Which language is primarily used for Android development?',
                    'options' => [
                        ['text' => 'Kotlin', 'is_correct' => true],
                        ['text' => 'Swift', 'is_correct' => false],
                        ['text' => 'Ruby', 'is_correct' => false],
                        ['text' => 'PHP', 'is_correct' => false],
                    ],
                    'explanation' => 'Kotlin is a primary language for Android development.',
                ],
                [
                    'text' => 'What is Laravel in PHP?',
                    'options' => [
                        ['text' => 'A web application framework', 'is_correct' => true],
                        ['text' => 'A database engine', 'is_correct' => false],
                        ['text' => 'A programming language', 'is_correct' => false],
                        ['text' => 'A server operating system', 'is_correct' => false],
                    ],
                    'explanation' => 'Laravel is a PHP framework for building web applications.',
                ],
                [
                    'text' => 'What is an API?',
                    'options' => [
                        ['text' => 'A set of rules for software communication', 'is_correct' => true],
                        ['text' => 'A type of database table', 'is_correct' => false],
                        ['text' => 'A programming bug', 'is_correct' => false],
                        ['text' => 'A hardware component', 'is_correct' => false],
                    ],
                    'explanation' => 'API stands for Application Programming Interface.',
                ],
                [
                    'text' => 'What does CSS stand for?',
                    'options' => [
                        ['text' => 'Cascading Style Sheets', 'is_correct' => true],
                        ['text' => 'Computer Style System', 'is_correct' => false],
                        ['text' => 'Creative Styling Syntax', 'is_correct' => false],
                        ['text' => 'Colorful Style Sheets', 'is_correct' => false],
                    ],
                    'explanation' => 'CSS stands for Cascading Style Sheets.',
                ],
                [
                    'text' => 'What is a loop in programming?',
                    'options' => [
                        ['text' => 'A way to repeat a block of code', 'is_correct' => true],
                        ['text' => 'A database query', 'is_correct' => false],
                        ['text' => 'A file type', 'is_correct' => false],
                        ['text' => 'A UI element', 'is_correct' => false],
                    ],
                    'explanation' => 'Loops repeat code until a condition changes.',
                ],
                [
                    'text' => 'Which data format is commonly used for APIs?',
                    'options' => [
                        ['text' => 'JSON', 'is_correct' => true],
                        ['text' => 'MP3', 'is_correct' => false],
                        ['text' => 'PNG', 'is_correct' => false],
                        ['text' => 'EXE', 'is_correct' => false],
                    ],
                    'explanation' => 'JSON is widely used for API data exchange.',
                ],
                [
                    'text' => 'What is frontend development?',
                    'options' => [
                        ['text' => 'Building the user interface of an app/website', 'is_correct' => true],
                        ['text' => 'Managing server hardware', 'is_correct' => false],
                        ['text' => 'Writing database backups', 'is_correct' => false],
                        ['text' => 'Creating operating systems', 'is_correct' => false],
                    ],
                    'explanation' => 'Frontend focuses on what users see and interact with.',
                ],
                [
                    'text' => 'Which of these is a relational database?',
                    'options' => [
                        ['text' => 'MySQL', 'is_correct' => true],
                        ['text' => 'Redis', 'is_correct' => false],
                        ['text' => 'MongoDB', 'is_correct' => false],
                        ['text' => 'ElasticSearch', 'is_correct' => false],
                    ],
                    'explanation' => 'MySQL is a relational database system.',
                ],
            ],

            // 2) Current Affairs (keep these more “stable” to avoid constant updates)
            [
                [
                    'text' => 'Which country hosted the 2024 Summer Olympics?',
                    'options' => [
                        ['text' => 'France', 'is_correct' => true],
                        ['text' => 'Japan', 'is_correct' => false],
                        ['text' => 'USA', 'is_correct' => false],
                        ['text' => 'Brazil', 'is_correct' => false],
                    ],
                    'explanation' => 'The 2024 Summer Olympics were hosted by France (Paris).',
                ],
                [
                    'text' => 'What does “UN” stand for?',
                    'options' => [
                        ['text' => 'United Nations', 'is_correct' => true],
                        ['text' => 'United Network', 'is_correct' => false],
                        ['text' => 'Universal Nations', 'is_correct' => false],
                        ['text' => 'Union of Nations', 'is_correct' => false],
                    ],
                    'explanation' => 'UN stands for United Nations.',
                ],
                [
                    'text' => 'Which is a commonly discussed global issue in current affairs?',
                    'options' => [
                        ['text' => 'Climate change', 'is_correct' => true],
                        ['text' => 'Stone age tools', 'is_correct' => false],
                        ['text' => 'Dinosaur pets', 'is_correct' => false],
                        ['text' => 'Mythical currencies', 'is_correct' => false],
                    ],
                    'explanation' => 'Climate change is a major global issue.',
                ],
                [
                    'text' => 'What is “inflation” generally related to?',
                    'options' => [
                        ['text' => 'Rising prices over time', 'is_correct' => true],
                        ['text' => 'Decreasing population', 'is_correct' => false],
                        ['text' => 'Falling gravity', 'is_correct' => false],
                        ['text' => 'Increasing rainfall', 'is_correct' => false],
                    ],
                    'explanation' => 'Inflation usually means prices rise and purchasing power falls.',
                ],
                [
                    'text' => 'Which organization is known for maintaining global peace and security?',
                    'options' => [
                        ['text' => 'United Nations', 'is_correct' => true],
                        ['text' => 'World Chess Federation', 'is_correct' => false],
                        ['text' => 'International Music Council', 'is_correct' => false],
                        ['text' => 'Global Movie Awards', 'is_correct' => false],
                    ],
                    'explanation' => 'The UN works on international peace and security.',
                ],
                [
                    'text' => 'Which is an example of a renewable energy source?',
                    'options' => [
                        ['text' => 'Solar energy', 'is_correct' => true],
                        ['text' => 'Coal', 'is_correct' => false],
                        ['text' => 'Natural gas', 'is_correct' => false],
                        ['text' => 'Diesel', 'is_correct' => false],
                    ],
                    'explanation' => 'Solar is renewable, unlike fossil fuels.',
                ],
                [
                    'text' => 'What does “GDP” commonly measure?',
                    'options' => [
                        ['text' => 'Total economic output of a country', 'is_correct' => true],
                        ['text' => 'Number of rivers in a country', 'is_correct' => false],
                        ['text' => 'Average height of citizens', 'is_correct' => false],
                        ['text' => 'Total land area only', 'is_correct' => false],
                    ],
                    'explanation' => 'GDP measures economic output.',
                ],
                [
                    'text' => 'Which is a common topic in international relations?',
                    'options' => [
                        ['text' => 'Diplomacy', 'is_correct' => true],
                        ['text' => 'Cartoon drawing', 'is_correct' => false],
                        ['text' => 'Magic tricks', 'is_correct' => false],
                        ['text' => 'Ancient myths only', 'is_correct' => false],
                    ],
                    'explanation' => 'Diplomacy is a key concept in international relations.',
                ],
                [
                    'text' => 'What is a “ceasefire”?',
                    'options' => [
                        ['text' => 'An agreement to stop fighting temporarily', 'is_correct' => true],
                        ['text' => 'A type of tax', 'is_correct' => false],
                        ['text' => 'A weather condition', 'is_correct' => false],
                        ['text' => 'A sports rule', 'is_correct' => false],
                    ],
                    'explanation' => 'Ceasefire means stopping hostilities for a period.',
                ],
                [
                    'text' => 'Which is an example of an international organization?',
                    'options' => [
                        ['text' => 'World Health Organization (WHO)', 'is_correct' => true],
                        ['text' => 'Local Street Committee', 'is_correct' => false],
                        ['text' => 'Neighborhood Club', 'is_correct' => false],
                        ['text' => 'School Classroom Group', 'is_correct' => false],
                    ],
                    'explanation' => 'WHO is an international organization.',
                ],
            ],

            // 3) Science & Nature
            [
                [
                    'text' => 'What is the chemical formula for water?',
                    'options' => [
                        ['text' => 'H2O', 'is_correct' => true],
                        ['text' => 'CO2', 'is_correct' => false],
                        ['text' => 'O2', 'is_correct' => false],
                        ['text' => 'NaCl', 'is_correct' => false],
                    ],
                    'explanation' => 'Water is made of two hydrogen atoms and one oxygen atom.',
                ],
                [
                    'text' => 'Who developed the theory of relativity?',
                    'options' => [
                        ['text' => 'Albert Einstein', 'is_correct' => true],
                        ['text' => 'Isaac Newton', 'is_correct' => false],
                        ['text' => 'Galileo Galilei', 'is_correct' => false],
                        ['text' => 'Marie Curie', 'is_correct' => false],
                    ],
                    'explanation' => 'Einstein developed the theory of relativity.',
                ],
                [
                    'text' => 'Which planet is closest to the Sun?',
                    'options' => [
                        ['text' => 'Mercury', 'is_correct' => true],
                        ['text' => 'Venus', 'is_correct' => false],
                        ['text' => 'Earth', 'is_correct' => false],
                        ['text' => 'Mars', 'is_correct' => false],
                    ],
                    'explanation' => 'Mercury is the closest planet to the Sun.',
                ],
                [
                    'text' => 'Which gas do humans need to breathe to survive?',
                    'options' => [
                        ['text' => 'Oxygen', 'is_correct' => true],
                        ['text' => 'Carbon dioxide', 'is_correct' => false],
                        ['text' => 'Nitrogen', 'is_correct' => false],
                        ['text' => 'Helium', 'is_correct' => false],
                    ],
                    'explanation' => 'Humans need oxygen for cellular respiration.',
                ],
                [
                    'text' => 'What organ pumps blood in the human body?',
                    'options' => [
                        ['text' => 'Heart', 'is_correct' => true],
                        ['text' => 'Lungs', 'is_correct' => false],
                        ['text' => 'Liver', 'is_correct' => false],
                        ['text' => 'Kidney', 'is_correct' => false],
                    ],
                    'explanation' => 'The heart pumps blood throughout the body.',
                ],
                [
                    'text' => 'Which element has atomic number 1?',
                    'options' => [
                        ['text' => 'Hydrogen', 'is_correct' => true],
                        ['text' => 'Helium', 'is_correct' => false],
                        ['text' => 'Oxygen', 'is_correct' => false],
                        ['text' => 'Carbon', 'is_correct' => false],
                    ],
                    'explanation' => 'Hydrogen is the first element in the periodic table.',
                ],
                [
                    'text' => 'What is photosynthesis?',
                    'options' => [
                        ['text' => 'Plants making food using sunlight', 'is_correct' => true],
                        ['text' => 'Animals hunting for food', 'is_correct' => false],
                        ['text' => 'Rocks forming into mountains', 'is_correct' => false],
                        ['text' => 'Water turning into ice', 'is_correct' => false],
                    ],
                    'explanation' => 'Photosynthesis converts light energy into chemical energy in plants.',
                ],
                [
                    'text' => 'Which part of the cell is called the “powerhouse”?',
                    'options' => [
                        ['text' => 'Mitochondria', 'is_correct' => true],
                        ['text' => 'Nucleus', 'is_correct' => false],
                        ['text' => 'Ribosome', 'is_correct' => false],
                        ['text' => 'Cell wall', 'is_correct' => false],
                    ],
                    'explanation' => 'Mitochondria produce energy (ATP) for the cell.',
                ],
                [
                    'text' => 'Which planet is famous for its rings?',
                    'options' => [
                        ['text' => 'Saturn', 'is_correct' => true],
                        ['text' => 'Mars', 'is_correct' => false],
                        ['text' => 'Mercury', 'is_correct' => false],
                        ['text' => 'Venus', 'is_correct' => false],
                    ],
                    'explanation' => 'Saturn has the most prominent ring system.',
                ],
                [
                    'text' => 'What is the boiling point of water at sea level?',
                    'options' => [
                        ['text' => '100°C', 'is_correct' => true],
                        ['text' => '0°C', 'is_correct' => false],
                        ['text' => '50°C', 'is_correct' => false],
                        ['text' => '150°C', 'is_correct' => false],
                    ],
                    'explanation' => 'At sea level, water boils at 100°C.',
                ],
            ],

            // 4) Mathematics & IQ
            [
                [
                    'text' => 'What is 12 x 12?',
                    'options' => [
                        ['text' => '144', 'is_correct' => true],
                        ['text' => '124', 'is_correct' => false],
                        ['text' => '132', 'is_correct' => false],
                        ['text' => '154', 'is_correct' => false],
                    ],
                    'explanation' => '12 multiplied by 12 equals 144.',
                ],
                [
                    'text' => 'What is the square root of 144?',
                    'options' => [
                        ['text' => '12', 'is_correct' => true],
                        ['text' => '14', 'is_correct' => false],
                        ['text' => '10', 'is_correct' => false],
                        ['text' => '16', 'is_correct' => false],
                    ],
                    'explanation' => '12 × 12 = 144, so √144 = 12.',
                ],
                [
                    'text' => 'Solve: 2 + 2 x 3 = ?',
                    'options' => [
                        ['text' => '8', 'is_correct' => true],
                        ['text' => '12', 'is_correct' => false],
                        ['text' => '10', 'is_correct' => false],
                        ['text' => '6', 'is_correct' => false],
                    ],
                    'explanation' => 'Multiplication first: 2×3=6, then 2+6=8.',
                ],
                [
                    'text' => 'What comes next in the series: 2, 4, 8, 16, ?',
                    'options' => [
                        ['text' => '32', 'is_correct' => true],
                        ['text' => '24', 'is_correct' => false],
                        ['text' => '20', 'is_correct' => false],
                        ['text' => '18', 'is_correct' => false],
                    ],
                    'explanation' => 'The series doubles each time.',
                ],
                [
                    'text' => 'If a train travels 60 km/h for 2 hours, how far does it go?',
                    'options' => [
                        ['text' => '120 km', 'is_correct' => true],
                        ['text' => '60 km', 'is_correct' => false],
                        ['text' => '30 km', 'is_correct' => false],
                        ['text' => '180 km', 'is_correct' => false],
                    ],
                    'explanation' => 'Distance = speed × time = 60×2 = 120 km.',
                ],
                [
                    'text' => 'What is 15% of 200?',
                    'options' => [
                        ['text' => '30', 'is_correct' => true],
                        ['text' => '25', 'is_correct' => false],
                        ['text' => '35', 'is_correct' => false],
                        ['text' => '40', 'is_correct' => false],
                    ],
                    'explanation' => '15% of 200 = 0.15 × 200 = 30.',
                ],
                [
                    'text' => 'Which number is prime?',
                    'options' => [
                        ['text' => '29', 'is_correct' => true],
                        ['text' => '21', 'is_correct' => false],
                        ['text' => '35', 'is_correct' => false],
                        ['text' => '49', 'is_correct' => false],
                    ],
                    'explanation' => '29 has no divisors other than 1 and 29.',
                ],
                [
                    'text' => 'What is the next prime number after 7?',
                    'options' => [
                        ['text' => '11', 'is_correct' => true],
                        ['text' => '9', 'is_correct' => false],
                        ['text' => '10', 'is_correct' => false],
                        ['text' => '12', 'is_correct' => false],
                    ],
                    'explanation' => 'Prime numbers after 7 are 11, 13, 17...',
                ],
                [
                    'text' => 'Solve: 5 + 3 x (2 + 1) = ?',
                    'options' => [
                        ['text' => '14', 'is_correct' => true],
                        ['text' => '24', 'is_correct' => false],
                        ['text' => '11', 'is_correct' => false],
                        ['text' => '18', 'is_correct' => false],
                    ],
                    'explanation' => '(2+1)=3, then 3×3=9, then 5+9=14.',
                ],
                [
                    'text' => 'If x + 3 = 10, what is x?',
                    'options' => [
                        ['text' => '7', 'is_correct' => true],
                        ['text' => '10', 'is_correct' => false],
                        ['text' => '13', 'is_correct' => false],
                        ['text' => '3', 'is_correct' => false],
                    ],
                    'explanation' => 'x = 10 − 3 = 7.',
                ],
            ],
        ];
    }

    /**
     * Shuffle options but keep correctness flag with each option.
     */
    private function shuffleOptionsPreserveCorrect(array $options): array
    {
        // Basic validation
        if (count($options) !== 4) {
            throw new \RuntimeException('Each question must have exactly 4 options.');
        }

        // Ensure at least one correct option exists
        $hasCorrect = false;
        foreach ($options as $opt) {
            if (!isset($opt['text'], $opt['is_correct'])) {
                throw new \RuntimeException('Option must contain text and is_correct keys.');
            }
            if ($opt['is_correct']) {
                $hasCorrect = true;
            }
        }
        if (!$hasCorrect) {
            throw new \RuntimeException('Each question must have at least one correct option.');
        }

        shuffle($options);
        return $options;
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GradingScheme;

class GradingSchemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gradingSchemes = [
            [
                'grade_name' => 'A+',
                'min_percentage' => 90.00,
                'max_percentage' => 100.00,
                'reward_amount' => 100.00,
                'is_active' => true,
            ],
            [
                'grade_name' => 'A',
                'min_percentage' => 80.00,
                'max_percentage' => 89.99,
                'reward_amount' => 70.00,
                'is_active' => true,
            ],
            [
                'grade_name' => 'B',
                'min_percentage' => 70.00,
                'max_percentage' => 79.99,
                'reward_amount' => 50.00,
                'is_active' => true,
            ],
            [
                'grade_name' => 'C',
                'min_percentage' => 60.00,
                'max_percentage' => 69.99,
                'reward_amount' => 30.00,
                'is_active' => true,
            ],
            [
                'grade_name' => 'D',
                'min_percentage' => 50.00,
                'max_percentage' => 59.99,
                'reward_amount' => 10.00,
                'is_active' => true,
            ],
            [
                'grade_name' => 'F',
                'min_percentage' => 0.00,
                'max_percentage' => 49.99,
                'reward_amount' => 0.00,
                'is_active' => true,
            ],
        ];

        foreach ($gradingSchemes as $scheme) {
            GradingScheme::create($scheme);
        }
    }
}

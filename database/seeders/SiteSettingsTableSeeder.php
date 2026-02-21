<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SiteSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Reset the site_settings table
         */
        $settingsCount = \DB::table('site_settings')->count();

        if (!$settingsCount) {

            \DB::table('site_settings')->insert([
                'site_title'            => 'QuizMaster',
                'contact_email'         => 'info@quizmaster.com',
                'facebook'              => 'https://www.facebook.com/',
                'youtube'               => 'https://www.youtube.com/',
                'linkedin'              => 'https://www.linkedin.com/',
                'pinterest'             => 'https://www.pinterest.com/',
                'footer_sentence'       => 'QuizMaster is an online quiz management platform where you can create, manage, and participate in quizzes easily. Our team provides powerful tools for quiz creation, real-time results, and detailed performance analytics.',
                'copyright'             => 'QuizMaster © 2026 All Rights Reserved.',
                'google_adsense_script' => '',
                'logo'                  => '',
                'favicon'               => '',
                'privacy_policy'        => '',
                'term_condition'        => '',
                'favicon'               => '',
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]);
        }
    }
}

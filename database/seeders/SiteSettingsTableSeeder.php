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
                'site_title'            => 'Softliee.com',
                'contact_email'         => 'info@softliee.com',
                'facebook'              => 'https://www.facebook.com/',
                'youtube'               => 'https://www.youtube.com/',
                'linkedin'              => 'https://www.linkedin.com/',
                'pinterest'             => 'https://www.pinterest.com/',
                'footer_sentence'       => 'Softliee is an online mobile phone website where you can discover the latest and updated mobile prices in Pakistan. Softliee`s team provides detailed features and specifications along with mobile prices in Pakistan.',
                'copyright'             => 'Softliee Pakistan © 2024 All Rights Reserved Softliee.com',
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

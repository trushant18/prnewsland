<?php

use Illuminate\Database\Seeder;

class SiteConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('site_configurations')->truncate();
        $site_configuration = [
            [
                'title' => "Site Email Address",
                'identifier' => 'email_address',
                'value' => 'kishan.patel@gmail.com',
                'control_type' => 'textfield',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => "Web Site Lnk",
                'identifier' => 'web_site',
                'value' => 'www.test.com',
                'control_type' => 'textfield',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => "Contact Number",
                'identifier' => 'contact_number',
                'value' => '+1 1234567890',
                'control_type' => 'textfield',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => "Address",
                'identifier' => 'address',
                'value' => '962 Fifth Avenue Str, 3rd Floor-Trump Building NY 10006, United State.',
                'control_type' => 'textfield',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => "Facebook Link",
                'identifier' => 'facebook_link',
                'value' => 'https://www.facebook.com/',
                'control_type' => 'textfield',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => "Youtube Link",
                'identifier' => 'youtube_link',
                'value' => 'https://www.youtube.com/',
                'control_type' => 'textfield',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => "Instagram Link",
                'identifier' => 'instagram_link',
                'value' => 'https://www.instagram.com/',
                'control_type' => 'textfield',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]
        ];
        DB::table('site_configurations')->insert($site_configuration);
    }
}

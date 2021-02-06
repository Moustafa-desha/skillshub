<?php

namespace Database\Seeders;

use App\Models\setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([

            'email' => 'skillshub@contact.com',
            'phone' => '89998068033',
            'facebook' => 'http://www.facebok.com',
            'twitter' => 'http://www.twitter.com',
            'instagram' => 'http://www.instagram.com',
            'youtube' => 'http://www.youtube.com',
            'linkedin' => 'http://www.linkein.com',

        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //هنا نضيف حميع الكلاسات لاضافة الجداول كلها مره واحده ف الداتا بيز بامر دى بى سيد
        $this->call([
                    CatSeeder::class,
                    RoleSeeder::class,
                    SettingSeeder::class,
                    UserSeeder::class,
        ]);
    }
}

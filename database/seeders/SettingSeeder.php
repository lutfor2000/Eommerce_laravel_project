<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            'setting_name' => 'phone',
            'setting_value' => '01798960830'
        ]);

        DB::table('settings')->insert([
            'setting_name' => 'email',
            'setting_value' => 'lutfor@gmail.com'
        ]);
    }
}

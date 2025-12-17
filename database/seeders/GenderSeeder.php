<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('genders')->delete();

        $gender = [
            ['name' => json_encode(['ar' => 'ذكر', 'en' => 'Male'])],
            ['name' => json_encode(['ar' => 'انثى', 'en' => 'Female'])],
        ];
        DB::table('genders')->insert($gender);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class grade extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('grades')->delete();
        $grades = [
            ['en' => 'Primary stage', 'ar' => 'المرحلة الابتدائية'],
            ['en' => 'middle School', 'ar' => 'المرحلة الاعدادية'],
            ['en' => 'High school', 'ar' => 'المرحلة الثانوية'],
        ];

        $data = [];
        foreach ($grades as $grade) {
            $data[] = [
                'Name' => json_encode($grade), // إذا كان الحقل JSON
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('grades')->insert($data);
    }
}

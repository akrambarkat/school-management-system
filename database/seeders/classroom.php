<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class classroom extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('class_rooms')->delete();
        $classrooms = [
            ['en' => 'First grade', 'ar' => 'الصف الاول'],
            ['en' => 'Second grade', 'ar' => 'الصف الثاني'],
            ['en' => 'Third grade', 'ar' => 'الصف الثالث'],
        ];

        foreach ($classrooms as $classroom) {
            DB::table('class_rooms')->insert([
                'name' => json_encode($classroom),
                'grade_id' => \App\Models\Grade::inRandomOrder()->first()->id, // يجلب Grade_id عشوائيًا
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('specializations')->delete();

        $subjects = [
            ['name' => json_encode(['ar' => 'الرياضيات', 'en' => 'Mathematics'])],
            ['name' => json_encode(['ar' => 'اللغة الإنجليزية', 'en' => 'English Language'])],
            ['name' => json_encode(['ar' => 'اللغة العربية', 'en' => 'Arabic Language'])],
            ['name' => json_encode(['ar' => 'العلوم', 'en' => 'Science'])],
            ['name' => json_encode(['ar' => 'التاريخ', 'en' => 'History'])],
            ['name' => json_encode(['ar' => 'الجغرافيا', 'en' => 'Geography'])],
            ['name' => json_encode(['ar' => 'التربية الإسلامية', 'en' => 'Islamic Education'])],
            ['name' => json_encode(['ar' => 'التربية البدنية', 'en' => 'Physical Education'])],
            ['name' => json_encode(['ar' => 'الفنون', 'en' => 'Arts'])],
            ['name' => json_encode(['ar' => 'الحاسب الآلي', 'en' => 'Computer Science'])],
            ['name' => json_encode(['ar' => 'الفيزياء', 'en' => 'Physics'])],
            ['name' => json_encode(['ar' => 'الكيمياء', 'en' => 'Chemistry'])],
            ['name' => json_encode(['ar' => 'الأحياء', 'en' => 'Biology'])],
            ['name' => json_encode(['ar' => 'الاقتصاد المنزلي', 'en' => 'Home Economics'])],
            ['name' => json_encode(['ar' => 'اللغة الفرنسية', 'en' => 'French Language'])],
        ];

        DB::table('specializations')->insert($subjects);
    }
}

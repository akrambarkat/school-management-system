<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('religions')->delete();

        $nationalities = [
            ['name' => json_encode(['ar' => 'مسلم', 'en' => 'Muslim'])],
            ['name' => json_encode(['ar' => 'مسيحي', 'en' => 'Christian'])],
            ['name' => json_encode(['ar' => 'غيرذلك', 'en' => 'Other'])],

        ];
        DB::table('religions')->insert($nationalities);
    }
}

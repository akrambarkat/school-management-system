<?php

namespace Database\Seeders;

use App\Models\Type_blode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class bloadtabelseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_blodes')->delete();

        $bgs = ['O-', 'O+', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'];

        foreach ($bgs as  $bg) {
            Type_blode::create(['Name' => $bg]);
        }
    }
}

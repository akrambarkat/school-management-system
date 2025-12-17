<?php

namespace Database\Seeders;

use App\Models\gender;
use App\Models\specialization;
use App\Models\User;
use Database\Seeders\user as SeedersUser;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(SeedersUser::class);
        $this->call(grade::class);
        $this->call(classroom::class);
        $this->call(bloadtabelseeder::class);
        $this->call(NationalitieSeeder::class);
        $this->call(ReligionSeeder::class);
        $this->call(SpecializationSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(SettingesTableSeeder::class);
    }
}

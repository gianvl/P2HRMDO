<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            EmployeeSeeder::class,
            EvalPageSeeder::class,
            ManpowersSeeder::class,
            ManpowerApprovalSeeder::class,
            ManpowerProcessingSeeder::class,
            ManpowerProcessingHireeSeeder::class,
            PositionFormMappingSeeder::class,
            ForecastSection1sSeeder::class,
            ForecastSection2sSeeder::class,
            ForecastSection3sSeeder::class,
            ForecastSection4sSeeder::class,
            ForecastSection5sSeeder::class,
            ForecastSection6sSeeder::class,
            ForecastSection7sSeeder::class,
            ForecastSection8sSeeder::class,
        ]);
    }
}

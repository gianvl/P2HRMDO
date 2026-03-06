<?php

namespace Database\Seeders;

use App\Models\ForecastSection2;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ForecastSection2sSeeder extends Seeder
{
    public function run(): void
    {
        // Clear records
        ForecastSection2::truncate();

        $forecastformCSVFile = fopen(base_path('database/data/forecastsection2s.csv'), "r");
        $firstline = true;
        while (($row = fgetcsv($forecastformCSVFile)) !== false) {
            echo implode(",", $row) . "\n";
            if (!$firstline) {
                $forecastdata = [
                    'emc_id' => $row[0],
                    'forecast_num_id' => $row[1],
                    'fulltimeperm' => $row[2],
                    'parttimeperm' => $row[3],
                    'fulltimecontrac' => $row[4],
                    'parttimecontrac' => $row[5],
                    'created_at' => $row[6],
                    'updated_at' => $row[7],
                ];
    
                ForecastSection2::create($forecastdata);
            }
            $firstline = false;
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\ForecastSection3;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ForecastSection3sSeeder extends Seeder
{
    public function run(): void
    {
        // Clear records
        ForecastSection3::truncate();

        $forecastformCSVFile = fopen(base_path('database/data/forecastsection3s.csv'), "r");
        $firstline = true;
        while (($row = fgetcsv($forecastformCSVFile)) !== false) {
            echo implode(",", $row) . "\n";
            if (!$firstline) {
                $forecastdata = [
                    'freplacement_id' => $row[0],
                    'forecast_num_id' => $row[1],
                    'namefacreplace' => $row[2],
                    'reasonreplace' => $row[3],
                    'reasonforhiring' => $row[4],
                    'created_at' => $row[5],
                    'updated_at' => $row[6],
                ];
    
                ForecastSection3::create($forecastdata);
            }
            $firstline = false;
        }
    }
}

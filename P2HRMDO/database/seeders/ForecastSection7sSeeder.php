<?php

namespace Database\Seeders;

use App\Models\ForecastSection7;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ForecastSection7sSeeder extends Seeder
{
    public function run(): void
    {
        // Clear records
        ForecastSection7::truncate();

        $forecastformCSVFile = fopen(base_path('database/data/forecastsection7s.csv'), "r");
        $firstline = true;
        while (($row = fgetcsv($forecastformCSVFile)) !== false) {
            echo implode(",", $row) . "\n";
            if (!$firstline) {
                $forecastdata = [
                    'servsubj_id' => $row[0],
                    'forecast_num_id' => $row[1],
                    'servsubj' => $row[2],
                    'ssubj1stnumsectopened' => $row[3],
                    'ssubj2ndnumsectopened' => $row[4],
                    'Total1s2sForecastServSubject' => $row[5],
                    'created_at' => $row[6],
                    'updated_at' => $row[7],
                ];
    
                ForecastSection7::create($forecastdata);
            }
            $firstline = false;
        }
    }
}

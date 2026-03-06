<?php

namespace Database\Seeders;

use App\Models\ForecastSection8;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ForecastSection8sSeeder extends Seeder
{
    public function run(): void
    {
        // Clear records
        ForecastSection8::truncate();

        $forecastformCSVFile = fopen(base_path('database/data/forecastsection8s.csv'), "r");
        $firstline = true;
        while (($row = fgetcsv($forecastformCSVFile)) !== false) {
            echo implode(",", $row) . "\n";
            if (!$firstline) {
                $forecastdata = [
                    'grand_total_id' => $row[0],
                    'forecast_num_id' => $row[1],
                    'grandt1st' => $row[2],
                    'grand2nd' => $row[3],
                    'forecastgrandtotal' => $row[4],
                    'created_at' => $row[5],
                    'updated_at' => $row[6],
                ];
    
                ForecastSection8::create($forecastdata);
            }
            $firstline = false;
        }
    }
}

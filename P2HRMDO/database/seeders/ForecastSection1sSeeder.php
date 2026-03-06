<?php

namespace Database\Seeders;

use App\Models\ForecastSection1;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ForecastSection1sSeeder extends Seeder
{
    public function run(): void
    {
        // Clear records
        ForecastSection1::truncate();

        $forecastformCSVFile = fopen(base_path('database/data/forecastsection1s.csv'), "r");
        $firstline = true;
        while (($row = fgetcsv($forecastformCSVFile)) !== false) {
            echo implode(",", $row) . "\n";
            if (!$firstline) {
                $forecastdata = [
                    'forecast_num_id' => $row[0],
                    'college' => $row[1],
                    'department' => $row[2],
                    'ay' => $row[3],
                    'semester' => $row[4],
                    'chairsignature' => $row[5],
                    'deansignature' => $row[6],
                    'directorsignature' => $row[7],
                    'vpasignature' => $row[8],
                    'approval_status' => $row[9],
                    'created_at' => $row[10],
                    'updated_at' => $row[11],
                ];
    
                ForecastSection1::create($forecastdata);
            }
            $firstline = false;
        }
    }
}

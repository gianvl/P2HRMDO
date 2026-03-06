<?php

namespace Database\Seeders;

use App\Models\ForecastSection5;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ForecastSection5sSeeder extends Seeder
{
    public function run(): void
    {
        // Clear records
        ForecastSection5::truncate();

        $forecastformCSVFile = fopen(base_path('database/data/forecastsection5s.csv'), "r");
        $firstline = true;
        while (($row = fgetcsv($forecastformCSVFile)) !== false) {
            echo implode(",", $row) . "\n";
            if (!$firstline) {
                $forecastdata = [
                    'jobspec_id' => $row[0],
                    'forecast_num_id' => $row[1],
                    'jsbachelor' => $row[2],
                    'jsmasters' => $row[3],
                    'jsalliedprog' => $row[4],
                    'yrsofteachexp' => $row[5],
                    'technicalskills' => $row[6],
                    'interpersonalskills' => $row[7],
                    'created_at' => $row[8],
                    'updated_at' => $row[9],
                ];
    
                ForecastSection5::create($forecastdata);
            }
            $firstline = false;
        }
    }
}

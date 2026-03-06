<?php

namespace Database\Seeders;

use App\Models\ForecastSection4;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ForecastSection4sSeeder extends Seeder
{
    public function run(): void
    {
        // Clear records
        ForecastSection4::truncate();

        $forecastformCSVFile = fopen(base_path('database/data/forecastsection4s.csv'), "r");
        $firstline = true;
        while (($row = fgetcsv($forecastformCSVFile)) !== false) {
            echo implode(",", $row) . "\n";
            if (!$firstline) {
                $forecastdata = [
                    'additional_fac_id' => $row[0],
                    'forecast_num_id' => $row[1],
                    'numaddfacmember' => $row[2],
                    'jspermfull' => $row[3],
                    'jspermpart' => $row[4],
                    'jscontracfull' => $row[5],
                    'jscontracpart' => $row[6],
                    'created_at' => $row[7],
                    'updated_at' => $row[8],
                ];
    
                ForecastSection4::create($forecastdata);
            }
            $firstline = false;
        }
    }
}

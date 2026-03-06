<?php

namespace Database\Seeders;

use App\Models\ForecastSection6;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ForecastSection6sSeeder extends Seeder
{
    public function run(): void
    {
        // Clear records
        ForecastSection6::truncate();

        $forecastformCSVFile = fopen(base_path('database/data/forecastsection6s.csv'), "r");
        $firstline = true;
        while (($row = fgetcsv($forecastformCSVFile)) !== false) {
            echo implode(",", $row) . "\n";
            if (!$firstline) {
                $forecastdata = [
                    'majorsubj_id' => $row[0],
                    'forecast_num_id' => $row[1],
                    'aydropdown1s' => $row[2],
                    'aydropdown2s' => $row[3],
                    'forecastSemester' => $row[4],
                    'studentpop1y1s' => $row[5],
                    'studentpop1y2s' => $row[6],
                    'Total1y1s2sstudent' => $row[7],
                    'numsectopened1y1s' => $row[8],
                    'numsectopened1y2s' => $row[9],
                    'Total1y1s2ssection' => $row[10],
                    'studentpop2y1s' => $row[11],
                    'studentpop2y2s' => $row[12],
                    'Total2y1s2sstudent' => $row[13],
                    'numsectopened2y1s' => $row[14],
                    'numsectopened2y2s' => $row[15],
                    'Total2y1s2ssection' => $row[16],
                    'studentpop3y1s' => $row[17],
                    'studentpop3y2s' => $row[18],
                    'Total3y1s2sstudent' => $row[19],
                    'numsectopened3y1s' => $row[20],
                    'numsectopened3y2s' => $row[21],
                    'Total3y1s2ssection' => $row[22],
                    'studentpop4y1s' => $row[23],
                    'studentpop4y2s' => $row[24],
                    'Total4y1s2sstudent' => $row[25],
                    'numsectopened4y1s' => $row[26],
                    'numsectopened4y2s' => $row[27],
                    'Total4y1s2ssection' => $row[28],
                    'studentpop5y1s' => $row[29],
                    'studentpop5y2s' => $row[30],
                    'Total5y1s2sstudent' => $row[31],
                    'numsectopened5y1s' => $row[32],
                    'numsectopened5y2s' => $row[33],
                    'Total5y1s2ssection' => $row[34],
                    'Total1sstudent' => $row[35],
                    'Total2sstudent' => $row[36],
                    'TotalStudentForecast' => $row[37],
                    'Total1ssection' => $row[38],
                    'Total2ssection' => $row[39],
                    'TotalSectionForecast' => $row[40],
                    'created_at' => $row[41],
                    'updated_at'=> $row[42],
                ];
    
                ForecastSection6::create($forecastdata);
            }
            $firstline = false;
        }
    }
}

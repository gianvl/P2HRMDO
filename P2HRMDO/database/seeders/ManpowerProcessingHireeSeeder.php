<?php

namespace Database\Seeders;

use App\Models\ManpowerProcessingHiree;
use Illuminate\Database\Seeder;

class ManpowerProcessingHireeSeeder extends Seeder
{
    public function run(): void
    {
        // Clear records
        ManpowerProcessingHiree::truncate();

        $manpowerreqCSVFile = fopen(base_path('database/data/manpowerprocessinghiree.csv'), "r");
        $firstline = true;
        while (($row = fgetcsv($manpowerreqCSVFile)) !== false) {
            echo implode(",", $row) . "\n";
            if (!$firstline) {
                $mrdata = [
                    'mrNumHiree' => $row[0],
                    'mrNumProcessing' => $row[1],
                    'hireeName' => $row[2],
                    'hireeDate' => $row[3],
                    'hireeRate' => $row[4],
                ];
    
                ManpowerProcessingHiree::create($mrdata);
            }
            $firstline = false;
        }
    }
}

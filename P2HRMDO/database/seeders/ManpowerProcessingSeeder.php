<?php

namespace Database\Seeders;

use App\Models\ManpowerProcessing;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\{
    DB,
    Hash
};

class ManpowerProcessingSeeder extends Seeder
{
    public function run(): void
    {
        // Clear records
        ManpowerProcessing::truncate();

        $manpowerreqCSVFile = fopen(base_path('database/data/manpowerprocessing.csv'), "r");
        $firstline = true;
        while (($row = fgetcsv($manpowerreqCSVFile)) !== false) {
            echo implode(",", $row) . "\n";
            if (!$firstline) {
                $mrdata = [
                    'mrNumProcessing' => $row[0],
                    'mrNum' => $row[1],
                    'college' => $row[2],
                    'department' => $row[3],
                    'ay' => $row[4],
                    'semester' => $row[5],
                    'num_emp_required' => $row[6],
                    'employment_status' => $row[7],
                    'position' => $row[8],
                    'category' => $row[9],
                    'category_textbox' => $row[10],
                    'replacement_dropdown' => $row[11],
                    'replacement_others_textbox' => $row[12],
                    'budget' => $row[13],
                    'fileInput' => null,
                    'expertise_textbox' => $row[15],
                    'regular' => $row[16],
                    'probationary' => $row[17],
                    'contractual' => $row[18],
                    'studassistant' => $row[19],
                    'total' => $row[20],
                    'approval_status' => $row[21],
                    'chairsignature' => $row[22],
                    'deansignature' => $row[23],
                    'vpasignature' => $row[24],
                    'directorsignature' => $row[25],
                    'daterequested' => $row[26],
                    'dateapproved' => $row[27],
                    'receivedBy' => $row[28],
                    'rank' => $row[29],
                    'datereceived' => $row[30],
                    'datecompleted' => $row[31],
                    "created_at" => Carbon::now()
                ];
    
                ManpowerProcessing::create($mrdata);
            }
            $firstline = false;
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\{
    Employee,
    User,
    EvalPage,
    Manpower

};
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\{
    DB,
    Hash
};

class ManpowersSeeder extends Seeder
{
    public function run(): void
    {
        // Clear records
        Manpower::truncate();

        $manpowerreqCSVFile = fopen(base_path('database/data/manpowers.csv'), "r");
        $firstline = true;
        while (($row = fgetcsv($manpowerreqCSVFile)) !== false) {
            echo implode(",", $row) . "\n";
            if (!$firstline) {
                $mrdata = [
                    'mrNum' => $row[0],
                    'college' => $row[1],
                    'department' => $row[2],
                    'ay' => $row[3],
                    'semester' => $row[4],
                    'num_emp_required' => $row[5],
                    'employment_status' => $row[6],
                    'position' => $row[7],
                    'category' => $row[8],
                    'category_textbox' => $row[9],
                    'replacement_dropdown' => $row[10],
                    'replacement_others_textbox' => $row[11],
                    'budget' => $row[12],
                    'fileInput' => null,
                    'expertise_textbox' => $row[14],
                    'regular' => $row[15],
                    'probationary' => $row[16],
                    'contractual' => $row[17],
                    'studassistant' => $row[18],
                    'total' => $row[19],
                    'approval_status' => $row[20],
                    'chairsignature' => $row[21],
                    'deansignature' => $row[22],
                    'daterequested' => $row[23],
                    "created_at"  => Carbon::now()
                ];
    
                Manpower::create($mrdata);
            }
            $firstline = false;
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\{
    Employee,
    User,
    EvalPage
};
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\{
    DB,
    Hash
};

class EvalPageSeeder extends Seeder
{
    public function run(): void
    {
        // Clear records
        Evalpage::truncate();

        $evalpageCSVFile = fopen(base_path('database/data/evalpages.csv'), "r");
        $firstline = true;
        while (($row = fgetcsv($evalpageCSVFile)) !== false) {
            echo implode(",", $row) . "\n";
            if (!$firstline) {
                $evalpagedata = [
                    'employee_id' => $row[1],
                    'ay' => $row[2],
                    'semester' => $row[3],
                    'awolna' => $row[4],
                    'absences' => $row[5],
                    'student' => $row[6],
                    'peer' => $row[7],
                    'dean' => $row[8],
                    'chairperson' => $row[9],
                    'empstatus' => $row[10],
                    'overallstatus' => $row[11],
                    "created_at" => Carbon::now()
                ];
    
                Evalpage::create($evalpagedata);
            }
            $firstline = false;
        }
    }
}

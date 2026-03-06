<?php

namespace Database\Seeders;

use App\Models\{
    Employee,
    User
};
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\{
    DB,
    Hash
};

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear records
        User::truncate();
        Employee::truncate();
        DB::table('model_has_roles')->truncate();

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Insert records
        $usersCSVFile = fopen(base_path('database/data/users.csv'), "r");
        $firstline = true;
        while (($row = fgetcsv($usersCSVFile)) !== false) {
            echo implode(",", $row) . "\n";

            if (!$firstline) {
                $user = [
                    // 'name' => $row[4].' '.$row[2].' '.$row[3], remove Mr/Ms etc
                    'name' => $row[2].' '.$row[3],
                    'email' => $row[4],
                    'username' => $row[5],
                    'password' => Hash::make('password123'),
                    'email_verified_at' => ($row[6]) ? $row[6] : null,
                    'college' => $row[7],
                    'department' => $row[8],
                    'position' => $row[9],
                    'image' => $row[11],
                    "created_at" => Carbon::now()
                ];
    
                $user = User::create($user);

                if ($user->position == "Coordinator") {
                    DB::table('model_has_roles')
                        ->insert([
                            "role_id" => 1,
                            "model_type" => 'App\Models\User',
                            "model_id" => $user->id,
                        ]);
                    
                } else if ($user->position == "Dean") {
                    DB::table('model_has_roles')
                        ->insert([
                            "role_id" => 2,
                            "model_type" => 'App\Models\User',
                            "model_id" => $user->id,
                        ]);
                }  else if ($user->position == "Chairperson") {
                    DB::table('model_has_roles')
                        ->insert([
                            "role_id" => 2,
                            "model_type" => 'App\Models\User',
                            "model_id" => $user->id,
                        ]);
                }  else if ($user->position == "VPA") {
                    DB::table('model_has_roles')
                        ->insert([
                            "role_id" => 3,
                            "model_type" => 'App\Models\User',
                            "model_id" => $user->id,
                        ]);
                } else if ($user->position == "HRMDO Director") {
                    DB::table('model_has_roles')
                        ->insert([
                            "role_id" => 3,
                            "model_type" => 'App\Models\User',
                            "model_id" => $user->id,
                        ]);
                }
            }
            $firstline = false;
        }
    }
}

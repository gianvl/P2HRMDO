<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{
    ModelHasRole,
    User
};
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // if (User::count() > 0) {
        //     return;
        // }

        // $user = User::create([
        //     'name' => 'superadmin',
        //     'username' => 'superadmin',
        //     'email' => 'superadmin@gmail.com',
        //     'email_verified_at' => now(), // set this to a valid date and time value
        //     'password' => Hash::make('password'), // use Hash::make() to hash the password
        // ]);
    }
}

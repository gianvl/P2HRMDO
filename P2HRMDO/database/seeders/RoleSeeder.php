<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Role::count() > 0) {
            return;
        }

        Role::create(['name' => 'AdminProcessing']);
        Role::create(['name' => 'UserRequesting']);
        Role::create(['name' => 'UserApproval']);
    }
}

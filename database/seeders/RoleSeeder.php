<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataRole = [
            'superadmin',
            'admin',
            'peserta',
            'ticketing',
            'akuntan',
        ];

        foreach ($dataRole as $key => $role) {
            Role::create(['name' => $role]);
        }
    }
}

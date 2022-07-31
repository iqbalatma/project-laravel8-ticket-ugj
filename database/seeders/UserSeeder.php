<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => 'Iqbal Atma Muliawan',
                'email' => 'iqbalatma@gmail.com',
                'password' => '$2y$10$JrQNMG8vPcKM10vs6ZX43.60VAQsFSaABGhsJcDnuh/282WS8/ki2',
            ]
        );
    }
}

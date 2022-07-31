<?php

namespace Database\Seeders;

use App\Models\Phase;
use Illuminate\Database\Seeder;

class PhaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataPhase = [
            [
                'name' => 'Early',
                'strdate' => '2022-08-07 00:00:00',
                'fnshdate' => '2022-08-14 00:00:00',
            ],
            [
                'name' => 'Presale 1',
                'strdate' => '2022-08-14 00:00:00',
                'fnshdate' => '2022-09-14 00:00:00',
            ],
            [
                'name' => 'Presale 2',
                'strdate' => '2022-09-14 00:00:00',
                'fnshdate' => '2022-10-14 00:00:00',
            ],
            [
                'name' => 'Prelase 3',
                'strdate' => '2022-10-14 00:00:00',
                'fnshdate' => '2022-10-30 00:00:00',
            ],
            [
                'name' => 'OTS',
                'strdate' => '2022-11-12 00:00:00',
                'fnshdate' => '2022-11-12 00:00:00',
            ]
        ];

        foreach ($dataPhase as $key => $phase) {
            Phase::create($phase);
        }
    }
}

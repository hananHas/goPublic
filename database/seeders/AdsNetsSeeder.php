<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdsNets;

class AdsNetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdsNets::factory()
            ->count(100)
            ->create();
    }
}

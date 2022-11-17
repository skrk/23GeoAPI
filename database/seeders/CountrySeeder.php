<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::factory()
            ->count(2)
            ->hasCity(1)
            ->create();
        Country::factory()
            ->count(2)
            ->hasCity(3)
            ->create();
        Country::factory()
            ->count(2)
            ->hasCity(5)
            ->create();
        Country::factory()
            ->count(2)
            ->hasCity(7)
            ->create();
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create two records (for Emirates and Bahrain) in the 'countries' table
        foreach (['Emirates', 'Bahrain'] as $sCountryName) {
            Country::create(['name' => $sCountryName]);
        }
    }
}

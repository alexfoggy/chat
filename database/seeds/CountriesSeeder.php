<?php

use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = json_decode(file_get_contents(resource_path('countries.json')), true);
        foreach ($countries as $country) {
            $new_country = \App\Models\Country::create([
                'name' => $country['name'],
                'native' => $country['native'],
                'capital' => $country['capital']
            ]);

            $languages = \App\Models\Language::whereIn('locale', $country['languages'])->get();
            $new_country->languages()->attach($languages->pluck('id'));
        }
    }
}

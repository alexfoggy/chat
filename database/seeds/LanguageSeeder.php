<?php

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $language = \App\Models\Language::all();
        if (!$language->count()) {

            $json_languages = json_decode(file_get_contents(resource_path('languages.json')), true);

//            dd($json_languages);

            foreach ($json_languages as $locale => $language) {
                \App\Models\Language::create([
                    'name' => $language['name'],
                    'native' => $language['native'],
                    'locale' => $locale,
                    'status' => true
                ]);
            }
        }
    }
}

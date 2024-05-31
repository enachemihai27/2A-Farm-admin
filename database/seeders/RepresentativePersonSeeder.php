<?php

namespace Database\Seeders;

use App\Models\MapData;
use App\Models\Person;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Seeder;

class RepresentativePersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(storage_path('app/public/persons.json'));

        $data = json_decode($json, true);

        foreach ($data as $person) {

            Person::create([
                'name' => $person['name'],
                'department' => $person['department'],
                'email' => $person['email'],
                'symbol' => $person['symbol'],
                'prefix' => $person['prefix'],
                'phone' => $person['phone'],
            ]);
        }
    }
}

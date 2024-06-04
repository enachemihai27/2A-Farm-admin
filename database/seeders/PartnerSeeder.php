<?php

namespace Database\Seeders;

use App\Models\MapData;
use App\Models\Partner;
use App\Models\Person;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(storage_path('app/public/partners.json'));

        $data = json_decode($json, true);

        foreach ($data as $partner) {

            Partner::create([
                'src' => $partner['src'],
                'name' => $partner['name'],
                'link' => $partner['link']
            ]);
        }
    }
}

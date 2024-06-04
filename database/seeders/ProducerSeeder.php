<?php

namespace Database\Seeders;

use App\Models\MapData;
use App\Models\Partner;
use App\Models\Person;
use App\Models\Producer;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Seeder;

class ProducerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(storage_path('app/public/producers.json'));

        $data = json_decode($json, true);

        foreach ($data as $producer) {

            Producer::create([
                'src' => $producer['src'],
                'name' => $producer['name'],
                'link' => $producer['link']
            ]);
        }
    }
}

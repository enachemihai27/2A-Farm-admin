<?php

namespace Database\Seeders;

use App\Models\MapData;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Seeder;

class MapDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(storage_path('app/public/mapData.json'));

        $data = json_decode($json, true);

        foreach ($data as $judet) {

            $pathColor = array_key_exists('pathColor', $judet) ? $judet['pathColor'] : null;

            MapData::create([
                'd' => $judet['d'],
                'title' => $judet['title'],
                'id' => $judet['id'],
                'symbol' => $judet['symbol'],
                'path' => $judet['path'],
                'textPath' => $judet['textPath'],
                'pathColor' => $pathColor
            ]);
        }
    }
}

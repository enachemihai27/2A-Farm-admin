<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(MapDataSeeder::class);
        $this->call(RepresentativePersonSeeder::class);
        $this->call(PartnerSeeder::class);
    }
}

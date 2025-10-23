<?php

namespace Database\Seeders;

use App\Models\Airport;
use Illuminate\Database\Seeder;

class AirportSeeder extends Seeder
{
    public function run(): void
    {
        $airports = [
            ['code' => 'CGK', 'name' => 'Bandara Internasional Soekarno-Hatta', 'city' => 'Jakarta'],
            ['code' => 'SUB', 'name' => 'Bandara Internasional Juanda', 'city' => 'Surabaya'],
            ['code' => 'DPS', 'name' => 'Bandara Internasional Ngurah Rai', 'city' => 'Denpasar'],
            ['code' => 'KNO', 'name' => 'Bandara Internasional Kualanamu', 'city' => 'Medan'],
            ['code' => 'UPG', 'name' => 'Bandara Internasional Sultan Hasanuddin', 'city' => 'Makassar'],
            ['code' => 'BDO', 'name' => 'Bandara Internasional Husein Sastranegara', 'city' => 'Bandung'],
            ['code' => 'YIA', 'name' => 'Bandara Internasional Yogyakarta', 'city' => 'Yogyakarta'],
            ['code' => 'LOP', 'name' => 'Bandara Internasional Lombok', 'city' => 'Mataram'],
            ['code' => 'PDG', 'name' => 'Bandara Internasional Minangkabau', 'city' => 'Padang'],
            ['code' => 'BPN', 'name' => 'Bandara Internasional Sultan Aji Muhammad Sulaiman', 'city' => 'Balikpapan'],
        ];

        foreach ($airports as $airport) {
            Airport::create($airport);
        }
    }
}
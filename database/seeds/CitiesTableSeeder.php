<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            'Paser', 'Kutai Barat', 'Kutai Kartanegara', 'Kutai Timur', 'Berau', 'Penajam Paser Utara', 'Mahakam Ulu', 'Balikpapan', 'Samarinda', 'Bontang'
        ];
        foreach ($cities as $city) {
            $data[] = [
                'name' => $city,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        DB::table('cities')->insert($data);
    }
}

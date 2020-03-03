<?php

use Illuminate\Database\Seeder;

class LogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logs')->insert([
            [
                'user_id' => 1,
                'message' => 'Menambahkan surat',
                'activity' => 'tambah',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'user_id' => 1,
                'message' => 'Menghapus surat',
                'activity' => 'hapus',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}

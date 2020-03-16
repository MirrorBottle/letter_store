<?php

use Illuminate\Database\Seeder;

class MailTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['susenas', 'sakernas', 'podes'];
        foreach ($types as $type) {
            $data[] = [
                'name' => $type,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        DB::table('mail_types')->insert($data);
    }
}

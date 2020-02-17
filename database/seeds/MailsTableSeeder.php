<?php

use Illuminate\Database\Seeder;

class MailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mails')->insert([
            'no_surat' => '3212309123001',
            'perihal' => 'Testing',
            'file' => 'file.pdf',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}

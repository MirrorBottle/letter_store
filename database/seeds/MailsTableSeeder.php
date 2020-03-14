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
            [
                'no_surat' => '3212309123001',
                'user_id' => 1,
                'city_id' => 1,
                'type_id' => 1,
                'perihal' => 'Testing',
                'doc' => 'file.docx',
                'html' => 'file.html',
                'pdf' => 'file.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'no_surat' => '213123124121',
                'user_id' => 1,
                'city_id' => 1,
                'type_id' => 2,
                'perihal' => 'Testing 2',
                'doc' => 'file2.docx',
                'html' => 'file2.html',
                'pdf' => 'file2.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}

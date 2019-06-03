<?php

use Illuminate\Database\Seeder;

class Configurations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configurations')->insert([
            [
                'key' => 'booking',
                'value' => '{ "excludes": { "ALL": [ "M","S", "N", "X", "V", "Q", "E" ] }}'
            ]
        ]);
    }
}

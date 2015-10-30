<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('people')->insert([
            'first_name' => 'Иван',
            'last_name' => 'Иванович Иванов',
            'descr' => 'Хороший человек',
        ]);
    }
}

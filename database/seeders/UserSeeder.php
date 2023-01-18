<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Иванов',
                'email' => 'info@datainlife.ru',
                'phone' => '88005553535',
                'birthday' => '1995-05-13',
                'password' => 'ivanov13',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Петров',
                'email' => 'job@datainlife.ru',
                'phone' => '84952000808',
                'birthday' => '2000-01-19',
                'password' => 'petrov19',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}

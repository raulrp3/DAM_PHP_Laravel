<?php

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
        $profession_id = DB::table('professions')->where('title', 'Desarrollador front-end')->value('id');

        DB::table('users')->insert([
            'name' => 'Raúl Ramírez',
            'email' => 'raul.ramirez@escuelaestech.es',
            'password' => bcrypt('estech'),
            'profession_id' => $profession_id
        ]);

        $profession_id = DB::table('professions')->where('title', 'Desarrollador back-end')->value('id');

        DB::table('users')->insert([
            'name' => 'Francisco Jesús Adán',
            'email' => 'francisco.adan@escuelaestech.es',
            'password' => bcrypt('estech'),
            'profession_id' => $profession_id
        ]);
    }
}

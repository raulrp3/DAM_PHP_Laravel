<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Profession;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profession_id = Profession::where('title', 'Desarrollador front-end')->value('id');

        User::create([
            'name' => 'Raúl Ramírez',
            'email' => 'raul.ramirez@escuelaestech.es',
            'password' => bcrypt('estech'),
            'profession_id' => $profession_id
        ]);

        $profession_id = Profession::where('title', 'Desarrollador back-end')->value('id');

        User::create([
            'name' => 'Francisco Jesús Adán',
            'email' => 'francisco.adan@escuelaestech.es',
            'password' => bcrypt('estech'),
            'profession_id' => $profession_id
        ]);
    }
}

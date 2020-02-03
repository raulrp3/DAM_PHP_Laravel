<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Profession;
use App\Models\UserProfile;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Raúl Ramírez',
            'email' => 'raul.ramirez@escuelaestech.es',
            'password' => bcrypt('estech'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Francisco Jesús Adán',
            'email' => 'francisco.adan@escuelaestech.es',
            'password' => bcrypt('estech'),
            'role' => 'user'
        ]);

        factory(User::class, 48)->create()->each(function($user){
            $user->profile()->create(
                factory(UserProfile::class)->raw()
            );
        });
    }
}

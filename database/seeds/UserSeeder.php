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
            'is_admin' => true
        ]);

        User::create([
            'name' => 'Francisco Jesús Adán',
            'email' => 'francisco.adan@escuelaestech.es',
            'password' => bcrypt('estech'),
            'is_admin' => false
        ]);

        factory(User::class, 48)->create()->each(function($user){
            $user->profile()->create(
                factory(UserProfile::class)->raw()
            );
        });
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Profession;
use App\Models\UserProfile;
use App\Models\Team;
use App\Models\Skill;

class UserSeeder extends Seeder
{
    protected $professions;
    protected $skills;
    protected $teams;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->fetchRelations();

        foreach(range(1, 50) as $index){
            $user = factory(User::class)->create([
                'team_id' => rand(0, 2) ? null : $this->teams->random()->id,
                'active' => rand(0, 3) ? true : false,
            ]);

            $user->skills()->attach($this->skills->random(rand(0, 2)));

            $user->profile->update([
                'profession_id' => rand(0, 2) ? $this->professions->random()->id : null,
            ]);
        }
    }

    protected function fetchRelations(){
        $this->professions = Profession::all();
        $this->skills = Skill::all();
        $this->teams = Team::all();
    }
}

<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [

    ];

    public function profession(){
        return $this->belongsTo(Profession::class);
    }

    public function profile(){
        return $this->hasOne(UserProfile::class)->withDefault();
    }

    public function skills(){
        return $this->belongsToMany(Skill::class, 'user_skill');
    }

    public function isAdmin(){
        return $this->role == 'admin';
    }

    public static function createUser($data){
        DB::transaction(function() use($data){
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'role' => $data['role'] ?? 'user',
            ]);
    
            $user->profile()->create([
                'bio' => $data['bio'],
                'twitter' => $data['twitter'] ?? null,
                'profession_id' => $data['profession'] ?? null,
            ]);

            $user->skills()->attach($data['skills'] ?? []);
        });
    }
}

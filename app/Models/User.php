<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'users';
    protected $perPage = 10;

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
    
    public function profile(){
        return $this->hasOne(UserProfile::class)->withDefault();
    }

    public function skills(){
        return $this->belongsToMany(Skill::class, 'user_skill');
    }

    public function team(){
        return $this->belongsTo(Team::class)->withDefault();
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

    public static function updateUser($data, $user){
        if($data['password'] != null){
            $data['password'] = bcrypt($data['password']);

            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'role' => $data['role'],
            ]);
        }else{
            unset($data['password']);

            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'role' => $data['role'],
            ]);
        }

        $user->profile()->update([
            'bio' => $data['bio'],
            'twitter' => $data['twitter'],
            'profession_id' => $data['profession']
        ]);

        $user->skills()->sync($data['skills'] ?? []);
    }
}

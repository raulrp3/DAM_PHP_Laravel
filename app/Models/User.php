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
        'first_name', 'last_name', 'email', 'password', 'role', 'state',
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
        'active' => 'bool',
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

    public function getNameAttribute(){
        return "{$this->first_name} {$this->last_name}";
    }

    public function setStateAttribute($value){
        $this->active = $value == 'active';
    }

    public function getStateAttribute(){
        if($this->active !== null){
            return $this->active ? 'active' : 'inactive';
        }
    }

    public static function createUser($data){
        DB::transaction(function() use($data){
            $user = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'role' => $data['role'] ?? 'user',
                'state' => $data['state'],
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
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'role' => $data['role'],
                'state' => $data['state'],
            ]);
        }else{
            unset($data['password']);

            $user->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'role' => $data['role'],
                'state' => $data['state'],
            ]);
        }

        $user->profile()->update([
            'bio' => $data['bio'],
            'twitter' => $data['twitter'],
            'profession_id' => $data['profession']
        ]);

        $user->skills()->sync($data['skills'] ?? []);
    }

    public function scopeSearch($query){
        $query->when(request('team'), function($query, $team){
            if($team === 'with_team'){
                $query->has('team');
            }elseif($team === 'without_team'){
                $query->doesntHave('team');
            }
        })->when(request('search'), function($query, $search){
            $query->where(function($query) use ($search){
                $query->where(DB::raw('CONCAT(first_name, " ", last_name)'), 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%")->orWhereHas('team', function($query) use ($search){
                    $query->where('name', 'like', "%{$search}%");
                });
            });
        });
    }

    public function scopeByState($query){
        if(request('state') == 'active'){
            return $query->where('active', true);
        }

        if(request('state') == 'inactive'){
            return $query->where('active', false);
        }
    }

    public function scopeByRole($query){
        if(in_array(request('role'), ['user', 'admin'])){
            $query->where('role', request('role'));
        }
    }
}

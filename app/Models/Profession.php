<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    protected $table = 'professions';

    public function profiles(){
        return $this->hasMany(UserProfile::class);
    }
}

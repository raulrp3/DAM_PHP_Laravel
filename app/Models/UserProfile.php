<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProfile extends Model
{
    use SoftDeletes;

    protected $fillable = ['bio', 'twitter', 'user_id', 'profession_id'];

    public function profession(){
        return $this->belongsTo(Profession::class)->withDefault();
    }
}

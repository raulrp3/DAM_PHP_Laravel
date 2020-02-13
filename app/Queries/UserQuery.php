<?php 

namespace App\Queries;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class UserQuery extends Builder{

    public function search(){
        $this->when(request('team'), function($query, $team){
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

        return $this;
    }

    public function byState(){
        if(request('state') == 'active'){
            return $this->where('active', true);
        }

        if(request('state') == 'inactive'){
            return $this->where('active', false);
        }

        return $this;
    }

    public function byRole(){
        if(in_array(request('role'), ['user', 'admin'])){
            $this->where('role', request('role'));
        }

        return $this;
    }
}
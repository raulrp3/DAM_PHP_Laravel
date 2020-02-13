<?php 

namespace App\Queries;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class UserQuery extends Builder{

    use FiltersQueries;

    protected function filterRules(): array{
        return [
            'search' => 'filled',
            'status' => 'in:active,inactive',
            'role' => 'in:admin,user',
        ];
    }

    public function filterBySearch(){
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

    public function filterByState($state){
        return $this->where('active', $state == 'active');
    }
}
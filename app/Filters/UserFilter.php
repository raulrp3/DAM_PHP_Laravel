<?php

namespace App\Filters;

use App\Queries\QueryFilter;
use Illuminate\Support\Facades\DB;

class UserFilter extends QueryFilter{
    public function rules(): array{
        return [
            'search' => 'filled',
            'status' => 'in:active,inactive',
            'role' => 'in:admin,user',
            'skills' => 'array|exists:skills,id',
        ];
    }

    public function filterBySearch($query){
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

        return $this;
    }

    public function filterByState($query, $state){
        return $query->where('active', $state == 'active');
    }

    public function filterBySkills($query, $skills){
        $subquery = DB::table('user_skill AS s')
            ->selectRaw('COUNT(s.id)')
            ->whereRaw('s.user_id = users.id')
            ->whereIn('skill_id', $skills);

        return $query->whereQuery($subquery, count($skills));
    }
}
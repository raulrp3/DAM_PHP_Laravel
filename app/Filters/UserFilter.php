<?php

namespace App\Filters;

use App\Queries\QueryFilter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UserFilter extends QueryFilter{
    public function rules(): array{
        return [
            'search' => 'filled',
            'status' => 'in:active,inactive',
            'role' => 'in:admin,user',
            'skills' => 'array|exists:skills,id',
            'from' => 'date_format:d/m/Y',
            'to' => 'date_format:d/m/Y',
        ];
    }

    public function filterBySearch($query){
        return $query->where(function($query){
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
        });
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

    public function filterByFrom($query, $date){
        $date = Carbon::createFromFormat('d/m/Y', $date);

        return $query->whereDate('created_at', '>=', $date);
    }

    public function filterByTo($query, $date){
        $date = Carbon::createFromFormat('d/m/Y', $date);

        return $query->whereDate('created_at', '<=', $date);
    }
}
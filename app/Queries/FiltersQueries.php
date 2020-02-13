<?php

namespace App\Queries;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

trait FiltersQueries{
    public function filterBy(array $filters){
        $rules = $this->filterRules();
        
        $validator = Validator::make($filters, $rules);

        foreach($validator->valid() as $name => $value){
            $method = 'filterBy'.Str::studly($name);

            if(method_exists($this, $method)){
                $this->$method($value);
            }else{
                $this->where($name, $value);
            }
        }

        return $this;
    }
}
<?php

namespace App\Queries;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

abstract class QueryFilter{
    protected $valid;

    abstract public function rules(): array;

    public function applyTo($query, array $filters){
        $rules = $this->rules();
        
        $validator = Validator::make($filters, $rules);
        $this->valid = $validator->valid();

        foreach($this->valid as $name => $value){
            $method = 'filterBy'.Str::studly($name);

            if(method_exists($this, $method)){
                $this->$method($query, $value);
            }else{
                $query->where($name, $value);
            }
        }

        return $query;
    }

    public function valid(){
        return $this->valid;
    }
}
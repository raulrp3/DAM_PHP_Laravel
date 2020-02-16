<?php

namespace App\Rules;

use App\Sortable;
use Illuminate\Contracts\Validation\Rule;

class SortableColumn implements Rule{
    private $columns;

    public function __construct(array $columns)
    {
        $this->columns = $columns;
    }

    public function passes($attribute, $value){
        if(!is_string($value)){
            return false;
        }

        [$column] = Sortable::info($value);

        return in_array($column, $this->columns);
    }

    public function message(){
        return 'El orden seleccionado no es válido.';
    }
}
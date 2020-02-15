<?php 

namespace App;

use Illuminate\Support\Arr;

class Sortable{

    protected $currentColumn;
    protected $currentDirection;
    protected $currentUrl;

    public function __construct($currentUrl)
    {
        $this->currentUrl = $currentUrl;
    }

    public function classes($column){
        if($this->currentColumn == $column && $this->currentDirection == 'asc'){
            return 'link-sortable link-sorted-up';
        }

        if($this->currentColumn == $column && $this->currentDirection == 'desc'){
            return 'link-sortable link-sorted-down';
        }

        return 'link-sortable';
    } 

    public function setCurrentOrder($order, $direction = 'asc'){
        $this->currentColumn = $order;
        $this->currentDirection = $direction; 
    }

    public function url($column){
        $direction = $this->currentColumn == $column && $this->currentDirection == 'asc' ? 'desc' : 'asc';

        return $this->currentUrl.'?'.Arr::query(['order' => $column, 'direction' => $direction]);
    }
}
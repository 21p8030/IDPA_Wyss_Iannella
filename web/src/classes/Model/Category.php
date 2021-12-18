<?php

namespace M151\Model;

class Category extends Model {
    public const DB_TABLE = 'categorys';
    public const DB_COLS = ['name','numberOfThreads'];

    public $name;
    public $numberOfThreads;
    
    public function getAllCategorys(){
        $data = $this->query();
        return $data;
    }

    public function getAmountThreads(){

    }

    public function UpdateThreadCount($name, $kind = false){
        $data = $this->updateCatecories($name, $kind);
        return $data;
    }

}
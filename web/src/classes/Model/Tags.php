<?php

namespace M151\Model;

class Tags extends Model {
    public const DB_TABLE = 'tags';
    public const DB_COLS = [ 'id', 'name'];

    public $id;
    public $name;

    public function getAllTags(){
        $data = $this->query();
        return $data;
    }

    public function getTagName(){
        $tags = [];
        $data = $this->query();
        foreach($data as $tag){
            array_push($tags, $tag->name);
        }
        return $tags;
    }

    public function storeNewTags($data){
        $tag = Tags::createModel($data);
        $data = $tag->save();
    }

    public function getByName($names){
        $data = $this->query("name in ({$names})");
        return $data;
    }

    public function getByThreadId($threadId){
        $data = $this->selectTagsByThreadId($threadId);
        return $data;
    }

    public function getById($TagId){
        $data = $this->query("id = {$TagId}");
        return $data;
    }
}
<?php

namespace M151\Model;

class ThreadTags extends Model {
    public const DB_TABLE = 'ThreadTags';
    public const DB_COLS = [ 'id', 'IdThread', 'tagId'];

    public $id;
    public $IdThread;
    public $tagId;

    public function getAllThreadTags(){
        $data = $this->query();
        return $data;
    }

    public function storeNewTags($data){
        $threadtag = ThreadTags::createModel($data);
        $data = $threadtag->save();
    }

    public function getByTagId($TagId){
        $data = $this->query("tagId = {$TagId}");
        return $data;
    }
}
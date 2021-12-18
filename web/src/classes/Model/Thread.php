<?php

namespace M151\Model;

class Thread extends Model {
    public const DB_TABLE = 'threads';
    public const DB_COLS = ['ThreadId','UserId', 'Date','Title','Body', 'Category'];

    public $ThreadId;
    public $UserId;
    public $Date;
    public $Title;
    public $Body;
    public $Category;

    public function getByUserId($UserId){
        $data = $this->query("UserId = {$UserId}");
        return $data;
    }

    public function getAllThreads(){
        $data = $this->query();
        return $data;
    }

    public function getThreadsCount(){
        $data = $this->countQuery(null, null, null, null, 'count');
        return $data;
    }

    public function getByThreadId($ThreadId){
        $data = $this->query("ThreadId = {$ThreadId}");
        return $data;
    }

    public function storeNewThread($data){
        $thread = Thread::createModel($data);
        $data = $thread->save();
        return $thread->id;
    }

    public function deleteThread($ThreadId){
        $data = $this->delete($ThreadId);
        return $data;
    }

    public function getByCategory($CategoryName){
        $data = $this->query("category = '{$CategoryName}'");
        return $data;
    }

}
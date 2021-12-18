<?php

namespace M151\Model;

class Post extends Model {
    public const DB_TABLE = 'posts';
    public const DB_COLS = ['PostId', 'ThreadId', "UserId" , 'AnswerId', 'Date','Body'];


    public $PostId;
    public $ThreadId;
    public $UserId;
    public $Date;
    public $AnswerId;
    public $Body;

    public function getByUserId($UserId){
        $data = $this->query("UserId = {$UserId}");
        return $data;
    }
    public function getPostsCount(){
        $data = $this->countQuery(null, null, null, null, 'count');
        return $data;
    }
    public function getByThreadId($ThreadId){
        $data = $this->query("ThreadId = {$ThreadId}");
        return $data;
    }
    public function getHighestByThreadId($ThreadId){
        $data = $this->query("ThreadId = {$ThreadId} AND AnswerId IS NULL");
        return $data;
    }

    public function getAnswersByThreadId($ThreadId){
        $data = $this->query("ThreadId = {$ThreadId} AND AnswerId IS NOT NULL");
        return $data;
    }

    public function getByPostId($PostId){
        $data = $this->query("PostId = {$PostId}");
        return $data;
    }

    public function getAllPosts(){
        $data = $this->query();
        return $data;
    }

    public function storeNewPost($data){
        $post = Post::createModel($data);
        $data = $post->save();
        return $post->id;
    }

    public function deletePost($PostId){
        $data = $this->delete($PostId);
        return $data;
    }

    public function getAnswersByPostId($PostId){
        $data = $this->query("AnswerId = {$PostId}");
        return $data;
    }

}
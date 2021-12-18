<?php
namespace M151\Controller;

use M151\Model\Thread;
use M151\Model\Tags;
use M151\Model\ThreadTags;
use M151\Http\Request;

use Smarty;

class TagsController extends Controller {

    public function TagsVerarbeitung($PostData, $newThreadId){
        //var_dump($newThreadId);
        $tags = new Tags();
        $test = $tags->getTagName();
        //var_dump(array_diff($PostData, $test));
        $newTags = array_diff($PostData, $test);
        //var_dump($newTags);
        foreach($newTags as $newTag){
            //var_dump($newTag);
            $data['id'] = null;
            $data['name'] = $newTag;
            $tags->storeNewTags($data);
        }

        $newTagsData = $tags->getByName(sprintf("'%s'", implode("','", $PostData ) ));
        $ThreadTag = new ThreadTags();
        foreach($newTagsData as $tagData){
            $data['IdThread'] = $newThreadId;
            $data['tagId'] = $tagData->id;
            $ThreadTag->storeNewTags($data);
        }

    }

    public function showTags(){

        $tags = new Tags();
        $tagsData = $tags->getAllTags();

        $view = new Smarty();
        $view->setTemplateDir(__DIR__.'/../../views/');
        $view->assign('tagsData', $tagsData);
        $view->display('tags.smarty');
    }

    public function showThreadByTag(Request $req){

        if ($req->getParam('id')) {
            $ThreadData = [];
            $tags = new Tags();
            $ThreadTags = new ThreadTags();
            $TagName = $tags->getById($req->getParam('id'));
            $ThreadIds = $ThreadTags->getByTagId($req->getParam('id'));
            $Threads = new Thread();
            foreach($ThreadIds as $ThreadId){
                array_push($ThreadData, $Threads->getByThreadId($ThreadId->IdThread)[0]);
            }
            
            
            $view = new Smarty();
            $view->setTemplateDir(__DIR__.'/../../views/');
            $view->assign('threadData', $ThreadData);
            $view->assign('Name', $TagName[0]->name);
            $view->display('allthreads.smarty');
        } else {
            header("Location:/tags");
            return;
        }
    }
}
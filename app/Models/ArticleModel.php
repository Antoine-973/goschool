<?php
namespace Model;
use Core\Model;

class ArticleModel extends Model{

    private $id;
    private $title;
    private $body;
    private $slug;


    public function save(){
        
    }
    public function getId(){
        return $this->id;
    }
    
    public function setTitle($title){
        $this->title = $title;
    }

    public function getTitle(){
        return $this->title;
    }
    
    public function setBody($body){
        $this->body = $body;
    }

    public function getBody(){
        return $this->body;
    }
    

    public function setSlug($slug){
        return $this->slug;
    }
    
    public function getSlug(){
        return $this->slug;
    }
 
}
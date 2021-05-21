<?php

namespace App\Model;
use Core\Database\Model;

class ArticleModel extends Model
{
    private $title;

    private $content;

    private $tag;

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setTag($tag)
    {
        $this->tag = $tag;
    }
    
    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getTag()
    {
        return $this->tag;
    }

    public function rules()
    {
        return [
            'firstname' => ['type' => 'string',  'min' => 3, 'required' => 'required', 'max' => 25],
            'lastname' => ['type' => 'string',  'min' => 3, 'required' => 'required', 'max' => 25],
            'username' => ['type' => 'string',  'min' => 3, 'required' => 'required', 'max' => 25],
            'email' => ['type' => 'email',  'min' => 8, 'required' => 'required', 'max' => 25],
            'password' => ['type' => 'password',  'min' => 6, 'required' => 'required', 'max' => 25],
            'passwordConfirm' => ['match' => 'password']
        ];

    }
}
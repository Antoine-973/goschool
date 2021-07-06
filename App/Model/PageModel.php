<?php

namespace App\Model;
use Core\Database\Model;

class PageModel extends Model
{
    private $title;

    private $content;

    private $url;


    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url): void
    {
        $this->url = $url;
    }

    public function rules()
    {
        return [
            'title' => ['type' => 'string',  'min' => 4, 'required' => 'required', 'max' => 55],
            'content' => ['type' => 'string', 'required' => 'required', 'max' => 400],
            'url' => ['id' => 'url', 'type' => 'string', 'required' => 'required', 'min' => 4, 'max' => 55],
        ];

    }
}
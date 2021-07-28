<?php

namespace App\Model;
use Core\Database\Model;

class PageModel extends Model
{
    private $title;

    private $content;

    private $url;

    private $description;

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }


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
            'title' => ['id' => 'name', 'type' => 'string', 'min' => 4, 'required' => 'required', 'max' => 55],
            'description' => ['id' => 'description', 'type' => 'string', 'max' => 160],
            'content' => ['type' => 'string', 'required' => 'required'],
            'url' => ['id' => 'url', 'type' => 'string', 'required' => 'required', 'min' => 1, 'max' => 55],
        ];

    }
}
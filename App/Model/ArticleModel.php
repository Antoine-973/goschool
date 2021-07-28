<?php

namespace App\Model;
use Core\Database\Model;

class ArticleModel extends Model
{
    private $title;

    private $content;

    private $slug;

    private $description;

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }
    
    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function rules()
    {
        return [
            'title' => ['id' => 'title', 'type' => 'string',  'min' => 4, 'required' => 'required', 'max' => 200],
            'slug' => ['id' => 'slug', 'type' => 'string',  'min' => 4, 'required' => 'required', 'max' => 220],
            'description' => ['id' => 'description', 'type' => 'string', 'max' => 160],
            'content' => ['type' => 'string', 'required' => 'required'],
        ];

    }
}
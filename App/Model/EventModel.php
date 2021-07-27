<?php


namespace App\Model;


use Core\Database\Model;

class EventModel extends Model
{
    private $title;
    private $slug;
    private $description;
    private $status;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function rules()
    {
        return [
            'title' => ['id' => 'title', 'type' => 'string',  'min' => 4, 'required' => 'required', 'max' => 150],
            'description' => ['type' => 'string', 'max' => 200],
        ];
    }
}
<?php
namespace App\Model;
use Core\Database\Model;


class CategoryModel extends Model
{
    private $name;

    private $slug;

    private $description;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

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

    public function rules()
    {
        return [
            'name' => ['id' => 'name', 'type' => 'string',  'min' => 4, 'required' => 'required', 'max' => 55],
            'slug' => ['id' => 'slug', 'type' => 'string',  'min' => 4, 'max' => 70],
            'description' => ['id' => 'description', 'type' => 'string', 'max' => 200],
        ];
    }
}
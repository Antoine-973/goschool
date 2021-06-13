<?php
namespace App\Model;
use Core\Database\Model;


class CategoryModel extends Model
{
    private $name;

    private $slug;

    private $description;

    private $image;

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

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    public function rules()
    {
        return [
            'name' => ['type' => 'string',  'min' => 4, 'required' => 'required', 'max' => 55],
            'slug' => ['type' => 'string',  'min' => 4, 'required' => 'required', 'max' => 55],
            'description' => ['type' => 'string', 'max' => 400],
            'image' => ['type' => 'string', 'max' => 400],
        ];
    }
}
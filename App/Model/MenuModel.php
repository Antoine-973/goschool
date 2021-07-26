<?php
namespace App\Model;
use Core\Database\Model;

class MenuModel extends Model
{
    private $name;

    private $description;

    private $position;

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position): void
    {
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
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
    public function getPosition()
    {
        return $this->position;
    }

    public function rules()
    {
        return [
            'name' => ['id' => 'title', 'type' => 'string',  'min' => 4, 'required' => 'required', 'max' => 55],
            'description' => ['type' => 'string', 'max' => 200],
        ];
    }
}
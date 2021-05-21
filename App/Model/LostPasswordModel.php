<?php
namespace App\Model;
use Core\Database\Validator;

class LostPasswordModel
{
    private $id;

    private $email;

    private $token;

    private $expires;

    private $createdAt;

    private $updatedAt;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function setExpires($expires)
    {
        $this->expires = $expires;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getExpires()
    {
        return $this->expires;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function rules()
    {
        return [
            'email' => ['type' => 'email',  'min' => 8, 'required' => 'required', 'max' => 55],
        ];
    }
}
<?php
namespace App\Model;
use Core\Database\Model;
use Core\Database\Validator;

class UserModel extends Model
{
    private $firstname;

    private $lastname;

    private $username;

    private $email;

    private $password;

    private $passwordConfirm;

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function rules()
    {
        return [
            'firstname' => ['type' => 'string',  'min' => 3, 'required' => 'required', 'max' => 25],
            'lastname' => ['type' => 'string',  'min' => 3, 'required' => 'required', 'max' => 25],
            'username' => ['type' => 'string',  'min' => 3, 'required' => 'required', 'max' => 55],
            'email' => ['type' => 'email',  'min' => 8, 'required' => 'required', 'max' => 55],
            'password' => ['type' => 'password',  'min' => 6, 'required' => 'required', 'max' => 55],
            'passwordConfirm' => ['match' => 'password']
        ];

    }
}
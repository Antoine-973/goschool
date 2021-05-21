<?php
namespace App\Query;

use Core\Database\QueryBuilder;
use Core\Util\Hash;

class UserQuery
{
    private $builder;

    public function __construct()
    {
        $this->builder = new QueryBuilder();

    }

    /**
     * @param int $id
     * @return string $query
     */
    public function getById(int $id)
    {
        $query = $this->builder->select("*")->from("users")->where("id = $id");
    
        return $query->getResult();
    
    }

    /**
     * @param string $roles
     */
    public function getByRole(string $roles)
    {
        $query = $this->builder->select("*")->from("users")->where("roles = $roles");
        return $query->getQuery();
    
    }

    /**
     * @param string $email
     */
    public function getByEmail(string $email)
    {
        $query = $this->builder->select("*")->from("users")->where("email = $email");
    
        return $query->getResult();
    }

    /**
     * @param string $email
     */
    public function getEmail(string $email)
    {
        $query = $this->builder->select("email")->from("users")->where("email = $email");

        return $query->getResult();
    }
    
    /**
     * @param string $firstname
     */
    public function getByFirstname(string $firstname)
    {
        $query = $this->builder->select("*")->from("users")->where("firstname = $firstname");
        return $query->getQuery();
    }

    /**
     * @param string $lastname
     */
    public function getByLastname(string $lastname)
    {
        $query = $this->builder->select("*")->from("users")->where("lastname = $lastname");
        return $query->getQuery();
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $query = $this->builder->delete()->from("users")->where("id = $id");
        return $query->getQuery();
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        
        $hash = new Hash();
        
        if(array_key_exists('password', $data) && array_key_exists('passwordConfirm', $data)){

            $data['password_hash'] = $hash->passwordHash($data['password']);

            unset($data["password"]); 
            unset($data["passwordConfirm"]);

            $query = $this->builder->insertInto("users")->columns($data)->values($data)->save();
            return $query;
        }
        
    }

    /**
     * @param array $data
     */
    public function update(array $data, int $id)
    {
        $query = $this->builder->update("users")->set($data)->where("id = $id");
        return $query;
    }

    /**
     * @param array $data
     */
    public function updatePassword(array $data, string $email)
    {
        $query = $this->builder->update("users")->set($data)->where("email = $email");
        return $query;
    }


    /**
     * @param string $roles
     */
    public function orderByRoles(string $roles)
    {
        $query = $this->builder->select("*")->from("users")->orderBy("roles", "ASC");
        return $query->getQuery();
    }

    /**
     * @param string $firstname
     */
    public function orderByFirstname(string $firstname)
    {
        $query = $this->builder->select("*")->from("users")->orderBy("firstname", "ASC");
        return $query->getQuery();
    }

    /**
     * @param string $lastname
     */
    public function orderByLastname(string $lastname)
    {
        $query = $this->builder->select("*")->from("users")->orderBy("lastname", "ASC");
        return $query->getQuery();
    }

    /**
     * @param int $created_at
     */
    public function orderByCreationDate(string $created_at)
    {
        $query = $this->builder->select("*")->from("users")->orderBy("created_at", "ASC");
        return $query->getQuery();
    }
}
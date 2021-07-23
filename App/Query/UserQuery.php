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
     * @return string $query
     */
    public function getUsers()
    {
        $query = $this->builder->select("users.id, firstname, lastname, email, roles.role")->from("users")->join('INNER', 'users', 'role_id', 'roles', 'id');
        
        return $query->getResult();
    }

    public function getUsersByEmail($email)
    {
        $query = $this->builder->select("id, firstname, lastname, email, roles")->from("users")->where("email = $email");

        return $query->getResult();
    }

    /**
     * @return array $data
     */
    public function getUsersMail()
    {
        $query = $this->builder->select('email')->from("users");
        return $query->getResult();
    }

    /**
     * @param int $id
     * @return string $query
     */
    public function getUserById($id)
    {
  
        $query = $this->builder->select("users.id, firstname, lastname, fullname, email, roles.role")->from("users")->join('INNER', 'users', 'role_id', 'roles', 'id')->where("users.id = $id");
    
        return $query->getResult();
    
    }

    public function getIdByEmail($email){
        $query = $this->builder->select("id")->from("users")->where("email = $email");
        return $query->getResult();
    }

    public function getEmailById($id){
        $query = $this->builder->select("email")->from("users")->where("id = $id");
        return $query->getResult();
    }

    /**
     * @param string $roles
     */
    public function getRole()
    {
        $query = $this->builder->select("DISTINCT roles")->from("users");
        return $query->getResult();
    }

    /**
     * @param string $roles
     */
    public function getRoleById($id)
    {
        $query = $this->builder->select("roles.role")->from("users")->join('INNER', 'users', 'role_id', 'roles', 'id')->where("users.id = $id");
        return $query->getResult();
    }

    /**
     * @param string $roles
     */
    public function getRoleIdById($id)
    {
        $query = $this->builder->select("roles.id")->from("users")->join('INNER', 'users', 'role_id', 'roles', 'id')->where("users.id = $id");
        return $query->getResult();
    }

    /**
     * @param string $roles
     */
    public function getByRole(string $roles)
    {
        $query = $this->builder->select("users.id")->from("users")->join('INNER', 'users', 'role_id', 'roles', 'id')->where("roles.role = $roles");
        return $query->getResult();
    
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
     * @param string $email
     */
    public function getVerified(string $email)
    {
        $query = $this->builder->select("verified")->from("users")->where("email = $email");

        return $query->getResult();
    }

    /**
     * @param string $email
     */
    public function getTokenVerified(string $email)
    {
        $query = $this->builder->select("token_verified")->from("users")->where("email = $email");

        return $query->getResult();
    }

    /**
     * @param string $email,
     * @param string $token_verified
     */
    public function getByEmailAndToken(string $email, string $token_verified)
    {
        $query = $this->builder->select("email, token_verified, verified")->from("users")->where("email = $email", "token_verified = $token_verified");

        return $query->getResult();
    }

    /**
     * @param string $email,
     * @param string $token_verified
     */
    public function getByEmailTokenVerified(string $email, string $token_verified)
    {
        $query = $this->builder->select("email, token_verified, verified")->from("users")->where("email = $email", "token_verified = $token_verified", "verified = 0");

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
        $query = $this->builder->delete()->from("users")->where("id = $id")->save();
        return $query;
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

            if (array_key_exists('role', $data)){
                $roleQuery = new RoleQuery();
                $role_id = $roleQuery->getIdbyName($data['role'])['id'];

                $data['role_id'] = $role_id;
                unset($data['role']);
            }

            $token_verified = [ 'token_verified' => md5( rand(0,1000) )];
            $finalData = $data + $token_verified;

            $query = $this->builder->insertInto("users")->columns($finalData)->values($finalData)->save();
            return $query;
        }
        
    }

    /**
     * @param array $data
     */
    public function update(array $data, int $id)
    {
        $hash = new Hash();

        if(array_key_exists('password', $data) && array_key_exists('passwordConfirm', $data)){

            $data['password_hash'] = $hash->passwordHash($data['password']);

            unset($data["password"]);
            unset($data["passwordConfirm"]);


            $query = $this->builder->update("users")->set($data)->where("id = $id")->save();
            return $query;
        }
    }

    /**
     * @param array $data
     */
    public function updatePassword(array $data, string $email)
    {
        $query = $this->builder->update("users")->set($data)->where("email = $email")->save();
        return $query;
    }

    /**
     * @param array $data
     */
    public function updateVerified(array $data, string $email, string $tokenVerified)
    {
        $query = $this->builder->update("users")->set($data)->where("email = $email", "token_verified = $tokenVerified")->save();
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
    public function orderByDateRegister()
    {
        $query = $this->builder->select("firstname, lastname, roles.role, users.created_at")->from("users")->join('INNER', 'users', 'role_id', 'roles', 'id')->orderBy('users.created_at', 'DESC')->limit(3);
        return $query->getResult();
    }
}
<?php
namespace Core\Util;

class Hash{

    /**
     * @return string $hash
     */
    public function passwordHash(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public function compareHash(string $password, $hash): bool
    {
        return (password_verify($password, $hash)) ? true : false;
    }
}
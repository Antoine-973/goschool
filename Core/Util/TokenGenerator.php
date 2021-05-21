<?php
namespace Core\Util;

class TokenGenerator{

    /**
     * @return string $token
     */
    public function generateToken(string $length) : string
    {
        return random_bytes($length);
    }

    /**
     * @return string $token
     */
    public function bin2hex(string $token) : string
    {
        return bin2hex($token);
    }

    /**
     * @return string $token
     */
    public function hex2bin(string $token) : string
    {
        return hex2bin($token);
    }

    /**
     * @param string $token
     * @param string $bin2hex
     * @return bool
     */
    public function compareBin2hex(string $token, string $bin2hex): bool
    {
        if (hex2bin($bin2hex) === $token)
        {
            return true;
        }
    }
}
<?php
namespace Core;
use Core\Database\DB;

class Kernel
{
    private static $db;

    public function __construct()
    {
        $db = new DB();
    }
    public static function getConnection()
    {
        return self::$db;
    }
}
<?php
namespace Core\Util;

class Table{

    public function is_multi(array $array):bool
    {
        return is_array($array[array_key_first($array)]);
    }

}



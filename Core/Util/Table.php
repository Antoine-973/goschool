<?php
namespace Core\Util;

class Table{

    public function is_multi(array $array):bool
    {
        return is_array($array[array_key_first($array)]);
    }

    public function multi_to_single(array $multiArray):array
    {
        if ($this->is_multi($multiArray)){
            $singleArray = array();
            foreach($multiArray as $array) {
                foreach($array as $key=>$value) {
                    array_push($singleArray,$value);
                }
            }
            return $singleArray;
        }
        else{
            return $multiArray;
        }
    }

}



<?php
namespace Core\ORM;

/**
 * @Annotation
 * @Annotation\Target("Property")
 */
class Annotation {

    /**
     * @Required
     * @var integer
     */
     public $integerType;
}
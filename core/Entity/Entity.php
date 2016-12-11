<?php
/**
 * Created by PhpStorm.
 * User: Aurore
 * Date: 08/05/2016
 * Time: 17:20
 */

namespace Core\Entity;


class Entity
{
    public function __get($key)
    {
        $method = 'get' . ucfirst($key);
        $this->$key = $this->$method();
        return $this->$key;
    }
}
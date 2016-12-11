<?php
/**
 * Created by PhpStorm.
 * User: Aurore
 * Date: 08/05/2016
 * Time: 14:49
 */

namespace App\Table;


use Core\Table\Table;

class UserTable extends Table
{
    public function selectUser($username){
        return $this->query("
            SELECT *
            FROM users
            WHERE username = ?
        ", [$username], true);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Aurore
 * Date: 09/05/2016
 * Time: 09:01
 */

namespace Core\Auth;

use Core\Database\Database;

class DBAuth
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getUserId()
    {
        if ($this->logged()) {
            return $_SESSION['auth'];
        }
        return false;
    }

    /**
     * @param $username
     * @param $password
     * @return boolean
     */
    public function login($username, $password)
    {
        $user = $this->db->prepare('SELECT * FROM users WHERE username = ?', [$username], null, true);

        if ($user) {
            if ($user->password === sha1($password)) {
                $_SESSION['auth'] = $user->id;
                $_SESSION['pseudo'] = $user->username;
                $_SESSION['groupe'] = $user->usersGroup;
                return true;
            }
        }
        return false;
    }

    public function logged()
    {
        return isset($_SESSION['auth']);
    }
    
    public function loggedAsAdmin(){
        if($_SESSION['groupe'] === 'admins'){
            return true;
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Aurore
 * Date: 10/05/2016
 * Time: 11:18
 */

namespace App\Controller;

use Core\Auth\DBAuth;
use \App;
use Core\HTML\Form;

class UsersController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('User');
    }

    public function login()
    {
        if (!isset($_SESSION['auth'])) {
            $error = false;
            if (!empty($_POST)) {
                $auth = new DBAuth(App::getInstance()->getDb());

                if ($auth->login($_POST['username'], $_POST['password'])) {
                    if($_SESSION['groupe'] === 'admins'){
                        App::redirect('admin.articles.index');
                    } else {
                        App::redirect('articles.index');
                    }
                } else {
                    $error = true;
                }
            }
            $form = new Form($_POST);
            $this->render('users.login', compact('form', 'error'));
        } else {
            if($_SESSION['groupe'] === 'admins'){
                App::redirect('admin.articles.index');
            } else {
                App::redirect('articles.index');
            }
        }
    }

    public function logout()
    {
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        App::redirect('articles.index');
    }
}
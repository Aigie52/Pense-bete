<?php
/**
 * Created by PhpStorm.
 * User: Aurore
 * Date: 10/05/2016
 * Time: 10:38
 */

namespace App\Controller\Admin;

use \App;
use Core\Auth\DBAuth;

class AppController extends \App\Controller\AppController
{
    protected $template = 'admin.default';

    public function __construct()
    {
        parent::__construct();

        //Authentification
        $app = App::getInstance();
        $auth = new DBAuth($app->getDb());
        if (!$auth->loggedAsAdmin()) {
            $this->forbidden();
        }
    }
}
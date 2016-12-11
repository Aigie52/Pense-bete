<?php
/**
 * Created by PhpStorm.
 * User: Aurore
 * Date: 17/05/2016
 * Time: 10:54
 */

namespace App\Controller\Admin;


class UsersController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('User');
    }

    public function index()
    {
        $users = $this->User->selectAll();
        $this->render('admin.users.index', compact('users'));
    }
}
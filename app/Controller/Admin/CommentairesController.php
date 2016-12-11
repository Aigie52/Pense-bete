<?php
/**
 * Created by PhpStorm.
 * User: Aurore
 * Date: 12/05/2016
 * Time: 15:46
 */

namespace App\Controller\Admin;


use Core\HTML\Flash;

class CommentairesController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Commentaire');
        $this->loadModel('Article');
    }

    public function index()
    {
        $articles = $this->Article->selectAll();
        $this->countComm($articles);
        $commentaires = $this->Commentaire->selectAll();
        $this->render('admin.commentaires.index', compact('articles', 'commentaires', '$articles->nb_items'));
    }


    public function delete()
    {
        $id_article = $_GET['id'];
        if (!empty($_POST['id'])) {
            $result = $this->Commentaire->delete($_POST['id']);
           if($result){
               $msgFlash = new Flash();
               $msgFlash->setFlash('messageSucces', 'Le commentaire a été supprimé !', 'alert-success');
               $msgFlash->flash();
               \App::redirect('admin.commentaires.index#article' . $id_article);
           }
        }
    }
}
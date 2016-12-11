<?php
/**
 * Created by PhpStorm.
 * User: Aurore
 * Date: 11/05/2016
 * Time: 12:09
 */

namespace App\Controller;


use Core\HTML\Flash;
use Core\HTML\Form;

class CommentairesController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Commentaire');
    }

    public function showComm()
    {
        $commentaires = $this->Commentaire->selectAll($_GET['id']);
        return $commentaires;
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
                \App::redirect('articles.single&id=' . $id_article);
            }
        }
    }
    
    public function edit(){
        $id_article = $_GET['id'];
        if (!empty($_POST['comm'])) {
            $comm = htmlspecialchars($_POST['comm']);
            $id = $_POST['id'];
            $result = $this->Commentaire->update($id,
                [
                    'commentaire' => $comm,
                ]);
            if($result){
                $msgFlash = new Flash();
                $msgFlash->setFlash('messageSucces', 'Le commentaire a été modifié !', 'alert-success');
                $msgFlash->flash();
                \App::redirect('articles.single&id=' . $id_article);
            }
        }
    }
}
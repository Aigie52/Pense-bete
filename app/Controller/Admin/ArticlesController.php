<?php
/**
 * Created by PhpStorm.
 * User: Aurore
 * Date: 10/05/2016
 * Time: 10:37
 */

namespace App\Controller\Admin;


use Core\HTML\Flash;
use Core\HTML\Form;

class ArticlesController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Article');
        $this->loadModel('Categorie');
        $this->loadModel('Commentaire');
    }

    public function index()
    {
        $articles = $this->paginate('Article');;
        $this->countComm($articles);
        $this->render('admin.articles.index', compact('articles', '$articles->nb_items'));
    }

    public function add()
    {
        $legend = 'Ajouter un article';
        if (!empty($_POST['titre']) && !empty($_POST['auteur']) && !empty($_POST['message'])) {
            $titre = htmlspecialchars($_POST['titre']);
            $auteur = htmlspecialchars($_POST['auteur']);
            $message = htmlspecialchars($_POST['message']);
            $categorie_id = $_POST['categorie'];

            $dateMsg = empty($_POST['dateMsg']) ? date('Y-m-d') : htmlspecialchars($_POST['dateMsg']);

            $result = $this->Article->insert(
                [
                    'dateMsg' => $dateMsg,
                    'titre' => $titre,
                    'auteur' => $auteur,
                    'message' => $message,
                    'categorie_id' => $categorie_id
                ]);
            if ($result) {
                header('Location: ?page=admin.articles.index');
            }
        }
        $categories = $this->Categorie->listElem('id', 'categorie');
        $form = new Form();
        $this->render('admin.articles.edit', compact('article', 'categories', 'form', 'legend'));
    }

    public function edit()
    {
        $legend = 'Modifier l\'article';
        if (!empty($_POST['titre']) && !empty($_POST['auteur']) && !empty($_POST['message'])) {
            $titre = htmlspecialchars($_POST['titre']);
            $auteur = htmlspecialchars($_POST['auteur']);
            $message = htmlspecialchars($_POST['message']);
            $categorie_id = $_POST['categorie'];
            $idMsg = $_POST['idMsg'];

            $dateMsg = empty($_POST['dateMsg']) ? date('Y-m-d') : htmlspecialchars($_POST['dateMsg']);

            $result = $this->Article->update($idMsg,
                [
                    'dateMsg' => $dateMsg,
                    'titre' => $titre,
                    'auteur' => $auteur,
                    'message' => $message,
                    'categorie_id' => $categorie_id
                ]);
            if ($result) {
                $msgFlash = new Flash();
                $msgFlash->setFlash('messageSucces', 'L\'article a bien été sauvegardé !', 'alert alert-success fadeout-message');
                $msgFlash->flash();
                \App::redirect('admin.articles.index');
            }
        }
        $categories = $this->Categorie->listElem('id', 'categorie');
        $article = $this->Article->selectOne($_GET['id']);;
        $form = new Form($article);
        $this->render('admin.articles.edit', compact('article', 'categories', 'form', 'legend'));
    }

    public function delete()
    {
        if (!empty($_POST['idMsg'])) {
            $this->Article->delete($_POST['idMsg']);
            $this->Commentaire->deleteWithArticle($_POST['idMsg']);
            header('Location: ?page=admin.articles.index');
        }
    }
}
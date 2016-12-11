<?php
/**
 * Created by PhpStorm.
 * User: Aurore
 * Date: 10/05/2016
 * Time: 09:23
 */

namespace App\Controller;


use Core\HTML\Flash;
use Core\HTML\Form;

class ArticlesController extends AppController
{
    public $nb_pages;

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Article');
        $this->loadModel('Categorie');
        $this->loadModel('Commentaire');
    }

    public function index()
    {
        $articles = $this->paginate('Article');
        $categories = $this->Categorie->selectAll();
        $this->countArticles($categories);
        $this->countComm($articles);
        $this->render('articles.index', compact('articles', 'categories', '$categorie->nb_items', '$articles->nb_items', '$this->nb_pages'));
    }

    public function categorie()
    {
        $articles = $this->Article->selectAllByCategorie($_GET['id']);
        $categories = $this->Categorie->selectAll();
        $categorie = $this->Categorie->selectOne($_GET['id']);
        if ($categorie == false) {
            $this->notFound();
        }
        $this->countArticles($categories);
        $this->countComm($articles);
        $this->render('articles.categorie', compact('articles', 'categories', 'categorie', '$categorie->nb_items', '$articles->nb_items'));
    }

    public function single()
    {

        if (isset($_GET['id'])) {
            if (!empty($_POST['comm'])) {
                $pseudo = $_SESSION['pseudo'];
                $comm = htmlspecialchars($_POST['comm']);
                $article_associe = $_GET['id'];

                $dateComm = date('Y-m-d H:i:s');

                $result = $this->Commentaire->insert(
                    [
                        'dateComm' => $dateComm,
                        'utilisateur' => $pseudo,
                        'commentaire' => $comm,
                        'article_associe' => $article_associe
                    ]);
                if ($result) {
                    $msgFlash = new Flash();
                    $msgFlash->setFlash('messageSucces', 'Votre commentaire a été ajouté !', 'alert-success');
                    $msgFlash->flash();
                }
            }
        }
        $article = $this->Article->selectOne($_GET['id']);
        $categories = $this->Categorie->selectAll();
        $commentaires = $this->Commentaire->selectAllByPost($_GET['id']);
        if ($article == false) {
            $this->notFound();
        }
        $this->titrePage = $article->titre;
        $this->countArticles($categories);
        $form = new Form();

        $this->render('articles.article', compact('article', 'categories', 'commentaires', 'form', '$categorie->nb_items'));
    }

    
}
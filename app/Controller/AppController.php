<?php
/**
 * Created by PhpStorm.
 * User: Aurore
 * Date: 10/05/2016
 * Time: 09:55
 */

namespace App\Controller;


use Core\Controller\Controller;
use \App;

class AppController extends Controller
{
    protected $template = 'default';
    protected $nb_pages;

    public function __construct()
    {
        $this->viewPath = ROOT . '/app/Views/';
    }

    protected function loadModel($model_name)
    {
        $this->$model_name = App::getInstance()->getTable($model_name);
    }

    protected function countArticles($categories)
    {
        foreach ($categories as $categorie) {
            $categorie->nb_items = $this->Article->countItemsByCategory($categorie->id);
        }
    }

    protected function countComm($articles)
    {
        foreach ($articles as $article) {
            $article->nb_items = $this->Commentaire->countItemsByPost($article->idMsg);
        }
    }

    protected function paginate($items)
    {
        $this->nb_pages = ceil($this->$items->countItems() / 5);
        if (isset($_GET['num_page'])) {
            $pageActuelle = intval($_GET['num_page']);
            if ($pageActuelle > $this->nb_pages) {
                $pageActuelle = $this->nb_pages;
            }
        } else {
            $pageActuelle = 1;
        }
        $msgDebut = ($pageActuelle - 1) * 5;

        return $this->$items->selectWithPagination($msgDebut);
    }
}
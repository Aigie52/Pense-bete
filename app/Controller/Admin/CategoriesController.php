<?php
/**
 * Created by PhpStorm.
 * User: Aurore
 * Date: 10/05/2016
 * Time: 13:18
 */

namespace App\Controller\Admin;


use Core\HTML\Form;

class CategoriesController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Categorie');
        $this->loadModel('Article');
    }

    public function index()
    {
        $categories = $this->Categorie->selectAll();
        $this->render('admin.categories.index', compact('categories'));
    }

    public function add()
    {
        $legend = 'Ajouter une catégorie';
        $form = new Form();

        if (!empty($_POST['categorie'])) {
            $categorie = htmlspecialchars($_POST['categorie']);

            $result = $this->Categorie->insert(
                [
                    'categorie' => $categorie,
                ]);
            if ($result) {
                header('Location: ?page=admin.categories.index');
            }
        }
        $this->render('admin.categories.edit', compact('categories', 'form', 'legend'));
    }

    public function edit()
    {
        $legend = 'Modifier la catégorie';

        if (!empty($_POST['categorie'])) {
            $categorie = htmlspecialchars($_POST['categorie']);

            $result = $this->Categorie->update($_GET['id'],
                [
                    'categorie' => $categorie,
                ]);
            if ($result) {
                header('Location: ?page=admin.categories.index');
            }
        }
        $categorie = $this->Categorie->selectOne($_GET['id']);
        $form = new Form($categorie);
        $this->render('admin.categories.edit', compact('categories', 'form', 'legend'));
    }

    public function delete()
    {
        if (!empty($_POST['id'])) {
            $articles = $this->Article->selectAllByCategorie($_POST['id']);
            foreach ($articles as $article) {
                $this->Article->update($article->idMsg,
                    [
                        'categorie_id' => 1
                    ]);
            }
            $this->Categorie->delete($_POST['id']);
            header('Location: ?page=admin.categories.index');
        }
    }
}
<article class="col-sm-10">
    <div class="entete_article">

        <h2><?= $article->titre; ?></h2>

        <p>
            Par <?= $article->auteur; ?>, le <?= date('d/m/Y', strtotime($article->dateMsg)); ?> dans la
            catégorie <a href="index.php?page=articles.categorie&id=<?= $article->categorie_id; ?>"
                         title="Catégorie"><?= $article->categorie; ?></a>
        </p>
    </div>
    <div>
        <p>
            <?= nl2br($article->message); ?>
        </p>
    </div>
    <hr/>
</article>
<?php
require(ROOT . '/app/Views/articles/modules/liste_categories.php');
require(ROOT . '/app/Views/articles/modules/liste_commentaires.php');
?>


		
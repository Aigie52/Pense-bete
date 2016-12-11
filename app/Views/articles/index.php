<article class="col-sm-10">
    <?php
    if ($articles) {
        foreach ($articles as $article):
            if ($article->dateMsg < date('Y-m-d H:i:s')) {
                ?>
                <div class="entete_article">
                    <h2><a href="<?= $article->url; ?>"><?= $article->titre; ?></a></h2>

                    <p>
                        Par <?= $article->auteur; ?>, le <?= date('d/m/Y', strtotime($article->dateMsg)); ?> dans la
                        catégorie <a href="index.php?page=articles.categorie&id=<?= $article->categorie_id; ?>"
                                     title="Catégorie"><?= $article->categorie; ?></a>
                    </p>
                </div>
                <div>
                    <p>
                        <?= nl2br($article->extrait); ?>
                    </p>
                </div>
                <p id="nbre_comm">
                    <?= $article->nb_items; ?> commentaire(s)
                </p>
                <hr/>
                <?php
            }
        endforeach;
    } else {
        ?>
        <p class="well">Il n'y a pas encore d'article publié !</p>
        <?php
    }
    ?>
    <p class="text-center">
        <?php
        for ($num = 1; $num <= $this->nb_pages; $num++) {
            ?>
            <a href="index.php?page=articles.index&num_page=<?= $num; ?>"><?= $num; ?></a>
            <?php
        }
        ?>
    </p>
</article>

<?php require ROOT . '/app/Views/articles/modules/liste_categories.php'; ?>

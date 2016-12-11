<h1>Administrer les articles</h1>

<p>
    <a href="index.php?page=admin.articles.add" class="btn btn-default">Ajouter un article</a>
</p>

<table class="table">
    <thead>
    <tr>
        <td>
            Date
        </td>
        <td>
            Titre
        </td>
        <td>
            Auteur
        </td>
        <td>
            Catégorie
        </td>
        <td>
            Actions
        </td>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($articles as $article): ?>
        <tr>
            <td><?= date('d/m/Y', strtotime($article->dateMsg)); ?></td>
            <td><?= $article->titre; ?><br/>
                <em><a href="?page=admin.commentaires.index#article<?= $article->idMsg; ?>"><?= $article->nb_items; ?>
                        commentaire(s)</a></em>
            </td>
            <td><?= $article->auteur; ?></td>
            <td><?= $article->categorie; ?></td>
            <td>
                <a href="?page=admin.articles.edit&id=<?= $article->idMsg; ?>" title="Editer"
                   class="btn btn-default">Modifier</a>
                <form method="post" role="form" action="?page=admin.articles.delete&id=<?= $article->idMsg; ?>"
                      style="display: inline;">
                    <input type="hidden" name="idMsg" value="<?= $article->idMsg; ?>">
                    <input type="submit" value="Supprimer" class="btn btn-danger">
                </form>

            </td>
        </tr>
        <?php
    endforeach;
    ?>
    </tbody>
</table>
<p class="text-center">
    <?php
    for ($num = 1; $num <= $this->nb_pages; $num++) {
        ?>
        <a href="index.php?page=admin.articles.index&num_page=<?= $num; ?>"><?= $num; ?></a>
        <?php
    }
    ?>
</p>

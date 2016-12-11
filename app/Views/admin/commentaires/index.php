<aside>
    <a href="index.php?page=admin.articles.index" title="Administration">Retourner sur la page d'administration</a>
</aside>
<h1>Administrer les commentaires</h1>
<div class="panel-group panel-default" id="accordeon">
    <?php foreach ($articles as $article):
        if ($article->nb_items != 0) {
            ?>
            <h3 class="panel-title panel-heading">
                <a data-toggle="collapse" data-parent="#accordeon"
                   href="#article<?= $article->idMsg; ?>"><?= $article->titre; ?> <span
                        class="glyphicon glyphicon-chevron-down pull-right"></span></a>
            </h3>
            <div id="article<?= $article->idMsg; ?>" class="panel-collapse collapse">
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <td>
                                Date
                            </td>
                            <td>
                                Utilisateur
                            </td>
                            <td>
                                Commentaire
                            </td>
                            <td>
                                Actions
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($commentaires as $commentaire):
                            if ($commentaire->article_associe === $article->idMsg) { ?>
                                <tr>
                                    <td><?= date('d/m/Y H:i', strtotime($commentaire->dateComm)); ?></td>
                                    <td><?= $commentaire->utilisateur; ?></td>
                                    <td><?= $commentaire->commentaire; ?></td>
                                    <td>
                                        <form method="post" role="form" action="?page=admin.commentaires.delete" style="display: inline;">
                                            <input type="hidden" name="id" value="<?= $commentaire->id; ?>">
                                            <input type="submit" value="Supprimer" class="btn btn-danger">
                                        </form>
                                    </td>
                                </tr>
                            <?php } endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } endforeach; ?>
</div>
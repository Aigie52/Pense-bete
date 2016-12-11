<div class="col-sm-6">
    <h3>Commentaires</h3>
    <?php
    use Core\HTML\Form;

    if (isset($_SESSION['auth'])) {
        ?>
        <a href="#ajout_commentaire" data-toggle="collapse">Ajouter un commentaire ?</a>
        <div id="ajout_commentaire" class="collapse">
            <form method="post" role="form" onsubmit="return verifAJoutComm(this)">
                <fieldset>
                    <?= $form->creaTextarea('comm', 5, 'Votre message'); ?>
                    <?= $form->creaSubmit('Valider'); ?>
                </fieldset>
            </form>
            <hr/>
        </div>
        <?php
    } else {
        ?>
        <p><em>Vous devez être connecté pour poster un commentaire.</em></p>
        <?php
    }
    if ($commentaires) {
        foreach ($commentaires as $commentaire): ?>
            <h4><b><?= $commentaire->utilisateur; ?></b></h4>

            <p>
                <em>Le <?= date('d/m/Y', strtotime($commentaire->dateComm)); ?>
                    à <?= date('H:i', strtotime($commentaire->dateComm)); ?></em>
            </p>
            <p>
                <?php echo nl2br($commentaire->commentaire); ?>
            </p>
            <?php
            if(isset($_SESSION['pseudo']) && $commentaire->utilisateur === $_SESSION['pseudo']){
                $form = new Form();
                ?>
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                    Modifier
                </button>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Modifier votre commentaire</h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" role="form" action="?page=commentaires.edit&id=<?= $_GET['id']; ?>"
                                      style="display: inline;">
                                    <input type="hidden" name="id" value="<?= $commentaire->id; ?>">
                                    <textarea name="comm" class="form-control" rows = 5><?php echo nl2br($commentaire->commentaire); ?></textarea>
                                    <input type="submit" value="Modifier" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <form method="post" role="form" action="?page=commentaires.delete&id=<?= $_GET['id']; ?>"
                                     style="display: inline;">
                    <input type="hidden" name="id" value="<?= $commentaire->id; ?>">
                    <input type="submit" value="Supprimer" class="btn btn-danger btn-sm">
                </form>
                <?php
            }
            ?>
            <hr/>
        <?php endforeach;
    } else {
        ?>
        <p class="well">Aucun commentaire</p>
        <?php
    }
    ?>

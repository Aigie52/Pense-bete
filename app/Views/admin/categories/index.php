<h1>Administrer les catégories</h1>

<p>
    <a href="?page=admin.categories.add" class="btn btn-default">Ajouter une catégorie</a>
</p>

<table class="table">
    <thead>
    <tr>
        <td>
            Titre
        </td>
        <td>
            Actions
        </td>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($categories as $categorie): ?>
        <tr>
            <td><?= $categorie->categorie; ?></td>
            <td>
                <a href="?page=admin.categories.edit&id=<?= $categorie->id; ?>" title="Editer"
                   class="btn btn-default">Modifier</a>
                <form method="post" role="form" action="?page=admin.categories.delete&id=<?= $categorie->id; ?>"
                      style="display: inline;">
                    <input type="hidden" name="id" value="<?= $categorie->id; ?>">
                    <input type="submit" value="Supprimer" class="btn btn-danger">
                </form>

            </td>
        </tr>
        <?php
    endforeach;
    ?>
    </tbody>
</table>

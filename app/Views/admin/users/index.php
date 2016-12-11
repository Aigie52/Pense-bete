<h1>Gérer les utilisateurs</h1>

<table class="table">
    <thead>
    <tr>
        <td>
            Pseudo
        </td>
        <td>
            Rôle
        </td>
        <td>
            Actions
        </td>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($users as $user): ?>
        <tr>
            <td><?= $user->username; ?></td>
            <td><?= $user->usersGroup; ?></td>
            <td>
                <a href="?page=admin.users.edit&id=<?= $user->id; ?>" title="Editer"
                   class="btn btn-default">Modifier</a>
                <form method="post" role="form" action="?page=admin.users.delete"
                      style="display: inline;">
                    <input type="hidden" name="id" value="<?= $user->id; ?>">
                    <input type="submit" value="Supprimer" class="btn btn-danger">
                </form>

            </td>
        </tr>
        <?php
    endforeach;
    ?>
    </tbody>
</table>

<aside>
    <a href="index.php?page=admin.categories.index" title="Administration">Retourner sur la page d'administration</a>
</aside>

<article>
    <form method="post" role="form" onsubmit="return verifForm(this)">
        <fieldset>
            <legend><?= $legend; ?></legend>
            <?= $form->creaInput('categorie', 'text', 'Catégorie'); ?>
            <?= $form->creaSubmit('Enregistrer les modifications'); ?>
        </fieldset>
    </form>
</article>
    
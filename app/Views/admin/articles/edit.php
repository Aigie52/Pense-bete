<aside>
    <a href="?page=admin.articles.index" title="Acdministration">Retourner sur la page d'administration</a>
</aside>

<article>
    <form method="post" role="form" onsubmit="return verifForm(this)">
        <fieldset>
            <legend><?= $legend; ?></legend>
            <?= $form->creaInput('idMsg', 'hidden'); ?>
            <?= $form->creaInput('titre', 'text', 'Titre'); ?>
            <?= $form->select('categorie', 'Catégorie', $categories); ?>
            <?= $form->creaInput('dateMsg', 'date', 'Date'); ?>
            <?= $form->creaInput('auteur', 'text', 'Auteur'); ?>
            <?= $form->creaTextarea('message', '20', 'Message'); ?>
            <?= $form->creaSubmit('Sauvegarder'); ?>
        </fieldset>
    </form>
</article>

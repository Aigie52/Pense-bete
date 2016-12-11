<form method="post">
    <fieldset>
        <legend>
            <h2>Connexion</h2>
        </legend>
        <?php if ($error): ?>
            <div class="alert alert-danger">Identifiants incorrects</div>
        <?php endif; ?>
        <?= $form->creaInput('username', 'text', 'Votre pseudo'); ?>
        <?= $form->creaInput('password', 'password', 'Votre mot de passe'); ?>
        <?= $form->creaSubmit('Se connecter'); ?>

    </fieldset>
</form>

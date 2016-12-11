<header class="container-fluid text-center">
    <h1>Pense-bête</h1>
    <?php if (isset($_SESSION['auth'])) {
        ?>
        <div class="container text-right">Bonjour, <?= $_SESSION['pseudo']; ?> !</div>
        <?php
    }
    ?>
    <nav class="navbar">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="index.php">Accueil<span class="sr-only">(current)</span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Catégories <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php foreach ($categories as $categorie):
                                if ($categorie->nb_items != 0) { ?>
                                    <li><a href="<?= $categorie->url; ?>"><?= $categorie->categorie; ?></a></li>
                                    <?php
                                }
                            endforeach; ?>
                        </ul>
                    </li>
                    <?php if (!isset($_SESSION['auth'])) {
                        ?>
                        <li><a href="index.php?page=users.login">Se connecter</a></li>
                        <?php
                    } else {
                        ?>
                        <li><a href="index.php?page=users.logout">Se déconnecter</a></li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </nav>
</header>
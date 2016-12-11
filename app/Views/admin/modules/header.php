<header class="container-fluid text-center">
    <h1>Pense-bête</h1>
    <div class="container text-right">Bonjour, <?= $_SESSION['pseudo']; ?> !</div>
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
                    <li class="active"><a href="index.php?page=admin.articles.index">Articles<span class="sr-only">(current)</span></a>
                    </li>
                    <li><a href="index.php?page=admin.categories.index">Catégories</a></li>
                    <li><a href="index.php?page=admin.users.index">Utilisateurs</a></li>
                    <li><a href="index.php">Retourner sur le site</a></li>
                    <li><a href="?page=users.logout">Se déconnecter</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
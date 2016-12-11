<aside class="col-sm-2" id="categories">
    <h4>Liste des catégories</h4>
    <ul>
        <?php
        foreach ($categories as $categorie):
            if ($categorie->nb_items != 0) {
                ?>
                <li><a href="<?= $categorie->url; ?>"><?= $categorie->categorie; ?> (<?= $categorie->nb_items; ?>
                        article(s))</a></li>
                <?php
            }
        endforeach; ?>
    </ul>
</aside>
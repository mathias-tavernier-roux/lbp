<h1>Page d'accueil des annonces</h1>
<?php
if (isset($_SESSION['success'])) : ?>
    <div class="alert alert-success text-center" role="alert">
        <?php echo $_SESSION['success'];
        unset($_SESSION['success']) ?>
    </div>
    <?php endif;

foreach ($annonces as $annonce) :
    if ($annonce->boutique_pro_id == null) {
        ?>
        <article>
            <h2><a href="<?php ACCUEIL  ?>annoncevoir/voirpar/<?= $annonce->id ?>"><?= $annonce->titre ?></a></h2>
            <p><?= $annonce->description ?></p>
        </article>
        <?php
    }else {
        ?>
        <article>
            <h2><a href="<?php ACCUEIL  ?>annoncevoir/voirpro/<?= $annonce->id ?>"><?= $annonce->titre ?></a></h2>
            <p><?= $annonce->description ?></p>
        </article>
        <?php
    }
   

 endforeach ?>
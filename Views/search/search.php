<section class="main_accueil">
    <h1>Resultats de la Recherche</h1>

<?php


use function App\functions\depuis;

use App\Models\CategorieModel;
use App\Models\PhotoAnnonceModel;
require 'functions/depuis.php';
?>
<section class="annonces_accueil">
        <?php
        $photo_annonce = new PhotoAnnonceModel;
        $categorie = new CategorieModel;
        foreach ($annonces as $annonce) {
            $categories = $categorie->findByIdCategorie($annonce->categorie_id);
            if ($annonce->boutique_pro_id == null) {
                // Boutique de particulier
                $photo_annonces = $photo_annonce->findPhotoByAnnonceId($annonce->id);
        ?>
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="../public/img/annonce/<?= $photo_annonces->photo ?>" alt="Image de l'annonce">
                    <div class="card-body">
                    <h5 class="card-title titre"><?= $annonce->titre ?></h5>
                        <p class="card-text prix">Prix: <?= $annonce->prix ?> €</p>
                        <p class="card-text categorie">Catégorie: <?= $categories->nom ?></p>
                        <p class="card-text depuis">En vente depuis <?= depuis($annonce->create_at) ?></p>
                        <?php
                        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 10 and $_SESSION['user']['boutique_id'] ==  $annonce->boutique_particulier_id) {
                            // Ceci est l'annonce de l'utilisateur connecté
                        ?>
                            <a href="../annoncevoir/boutiquepar/<?= $annonce->id . '/' . $annonce->id ?>" class="btn btn-primary col-12">Voir l'annonce</a>
                        <?php
                        } else {
                            // Ceci n'est pas l'annonce de l'utilisateur connecté
                        ?>
                            <a href="../annoncevoir/voirpar/<?= $annonce->id ?>" class="btn btn-primary col-12">Voir l'annonce</a>
                        <?php
                        }
                        ?>

                    </div>
                </div>
            <?php
            } else {
                // Boutique de professionnel
                $photo_annonces = $photo_annonce->findPhotoByAnnonceId($annonce->id);
            ?>
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="public/img/annonce/<?= $photo_annonces->photo ?>" alt="Image de l'annonce">
                    <div class="card-body">
                    <h5 class="card-title titre"><?= $annonce->titre ?></h5>
                        <p class="card-text prix">Prix: <?= $annonce->prix ?> €</p>
                        <p class="card-text categorie">Catégorie: <?= $categories->nom ?></p>
                        <p class="card-text depuis">En vente depuis <?= depuis($annonce->create_at) ?></p>
                        <?php
                        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 20 and $_SESSION['user']['id'] ==  $annonce->boutique_pro_id) {
                            // Ceci est l'annonce de l'utilisateur connecté
                        ?>
                            <a href="../annoncevoir/boutiquepro/<?= $annonce->id . '/' . $annonce->id ?>" class="btn btn-primary col-12">Voir l'annonce</a>
                        <?php
                        } else {
                            // Ceci n'est pas l'annonce de l'utilisateur connecté
                        ?>
                            <a href="../annoncevoir/voirpro/<?= $annonce->id ?>" class="btn btn-primary col-12">Voir l'annonce</a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
        <?php
            }
        } ?>
    </section>
</section>
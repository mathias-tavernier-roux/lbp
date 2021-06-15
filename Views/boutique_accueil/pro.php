<?php

use App\Models\PhotoAnnonceModel;
use App\Models\CategorieModel;
use function App\functions\depuis;

require 'functions/depuis.php';
?>
<section class="boutique_accueil_main">
    <h1>Boutique de professionnel</h1>
    <?php
    if (isset($_SESSION['erreur'])) {

        echo '<div class="alert alert-danger text-center col-12" role="alert">' . $_SESSION['erreur'] . '</div>';
        unset($_SESSION['erreur']);
    }
    if (isset($_SESSION['success'])) {

        echo '<div class="alert alert-success text-center col-12" role="alert">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
    }
    ?>
    <section class="boutique_accueil">
        <section class="profil">
            <section class="avatar">
                <?php
                if ($photo == false) { ?>
                    <img src="<?= ACCUEIL  ?>public\img\default\18.png" alt="photo de la boutique par default">
                <?php
                } else { ?>
                    <img src="<?= ACCUEIL  ?>public\img\boutique_pro\<?= $photo->photo ?>" alt="photo de la boutique pro">
                <?php
                }
                ?>
                <p><?= $boutique->nom ?></p>
            </section>

            <section class="note">
                <?php
                if (isset($note)) {
                    echo "note";
                } else {
                    echo "5 étoiles";
                }
                ?>

            </section>
        </section>

        <section class="annonces">
            <?php
            $categorie = new CategorieModel;
            if (isset($annonce) and !empty($annonce)) {
                foreach ($annonce as $annonces) {
                    $categories = $categorie->findByIdCategorie($annonces->categorie_id); ?>
                    <section class="annonce">
                        <a href="<?= ACCUEIL ?>annoncevoir/voirpro/<?= $annonces->id ?>">
                            <section class="photo">
                                <?php $photo_annonces = new PhotoAnnonceModel;
                                $photo_annonces = $photo_annonces->findPhotoByAnnonceId($annonces->id);
                                ?>
                                <img src="../../public/img/annonce/<?= $photo_annonces->photo ?>" alt="photo principale de l'annonce">

                            </section>
                            <section class="description">
                                <div class="titre"><?= $annonces->titre ?></div>
                                <div class="prix"><?= $annonces->prix ?> €</div>
                                <div class="categorie">Catégorie: <?= $categories->nom ?></div>
                                <div class="date_annonce">En vente depuis <?= depuis($annonces->create_at) ?></div>
                            </section>
                        </a>
                    </section>
                <?php
                }
            } else { ?>

                <p class="text-center col-12">Pas d'annonces publiées</p>
            <?php
            } ?>
        </section>
    </section>
</section>
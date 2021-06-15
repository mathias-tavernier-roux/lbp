<?php

use App\Models\PhotoAnnonceModel;
use App\Models\CategorieModel;
use function App\functions\depuis;

require 'functions/depuis.php';

?>
<section class="boutique_accueil_main">
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
    <h1>Ma boutique</h1>
    <section class="boutique_accueil">
        <section class="profil">
            <section class="avatar">
                <?php
                if (empty($photo)) { ?>
                    <img src="../public\img\default\18.png" alt="boutique">
                <?php
                } else { ?>
                    <img src="../public\img\boutique_pro\<?= $photo->photo ?>" alt="photo de la boutique pro">
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
            <section class="modifier">
                <a class="btn btn-primary col-12" href="<?= ACCUEIL ?>boutiqueProfil/profilPro">Modifier son profil</a>
            </section>
        </section>

        <section class="annonces">
            <?php
            $categorie = new CategorieModel;
            $photo_annonces = new PhotoAnnonceModel;
            if (isset($annonce) and !empty($annonce)) {
                foreach ($annonce as $annonces) {
                    $categories = $categorie->findByIdCategorie($annonces->categorie_id); ?>
                    <section class="annonce">
                        <a href="<?= ACCUEIL ?>annonceVoir/boutiquePro/<?= $boutique->id ?>/<?= $annonces->id ?>">
                            <section class="photo">
                                <?php
                                $photo_annonces = $photo_annonces->findPhotoByAnnonceId($annonces->id);
                                ?>
                                <img src="../public/img/annonce/<?= $photo_annonces->photo ?>" alt="photo principale de l'annonce">

                            </section>
                            <section class="description">
                                <div class="titre"><?= $annonces->titre ?></div>
                                <div class="prix">Prix: <?= $annonces->prix ?> €</div>
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
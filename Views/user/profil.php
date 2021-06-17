<?php

use function App\functions\depuis;

require 'functions/depuis.php';
?>
<section class="profil_profil">
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
    <h1>Mon profil</h1>
    <section class="profil_user">
        <section class="photo">
            <?php
            if (empty($photo->photo)) { ?>
                <img src="../public/img/default/avatar.jpg" alt="Photo de la boutique">
            <?php
            } else { ?>
                <img src="../public/img/avatar/<?= $photo->photo ?>" alt="Photo de la boutique">
            <?php
            }
            ?>
        </section>
        <section class="description">
            <div class="nom"><?= ucfirst($user->nom) . ' ' . ucfirst($user->prenom) ?></div>
            <div class="date">Membre depuis <?= depuis($user->create_at) ?></div>
            <div class="ville"><?php if (isset($adresse) and $adresse !== false) {
                                    echo $adresse->ville;
                                } else {
                                    echo "Pas d'adresse renseignée";
                                } ?></div>
            <div class="modifier"><a class="btn btn-primary text-center col-10" href="<?= ACCUEIL ?>user/profil">Modifier mon profil</a></div>
        </section>
    </section>
    <section class="boutique">
        <div class="boutique">
            <?php
            if ($_SESSION['user']['droit'] != 10) { ?>
                <a class="btn btn-secondary text-center col-10 btn-danger" href="<?= ACCUEIL ?>creer/index">Crée ta boutique</a>
            <?php
            } else { ?>
                <a class="btn btn-primary text-center col-10 btn-danger" href="<?= ACCUEIL ?>boutiqueAccueil/accueilpar">Ma boutique</a>
            <?php
            } ?>
        </div>
    </section>
</section>
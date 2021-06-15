<?php
use function App\functions\depuis;
require 'functions/depuis.php';
?>
<section class="boutique_par_page">
    <?php
    if (isset($_SESSION['erreur'])) {
        echo '<div class="alert alert-danger text-center" role="alert">' . $_SESSION['erreur'] . '</div>';
        unset($_SESSION['erreur']);
    }
    if (isset($_SESSION['success'])) {
        echo '<div class="alert alert-success text-center" role="alert">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
    }
    ?>
    <h1>Annonce de particulier</h1>
    <section class="boutique_par_container">
        <section class="boutique_par">
        <section class="photo_container">
            <img src="../../public/img/annonce/<?= $photo->photo ?>" alt="photo de l'annonce">
        </section>
        <section class="description_container">
            <section class="description_boutique_par">
                <div class="titre"><?= $annonce->titre ?></div>
                <?php $_SESSION['IDA'] = $annonce->id ?>
                <?php $_SESSION['Nom'] = $annonce->titre ?>
                <?php $_SESSION['Vendeur'] = $boutique->nom ?>
                <div class="description"><b>Description:</b><br><?= $annonce->description ?></div>
                <div class="stock">Stock : <?= $annonce->stock ?></div>
                <div class="prix">Prix: <?= $annonce->prix ?> €</div>
                <?php $_SESSION['Prix'] = $annonce->prix + $livraison->prix ?>
                <div class="livraison">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-truck text-info mb-1" viewBox="0 0 16 16">
                        <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                    </svg>
                    <?= $livraison->prix ?> €
                </div>
                <div class="date_annonce">publiée il y a <?= depuis($annonce->create_at) ?></div>
                <?php $STOCK_MAX = $annonce->stock;
                $STOCK = 0; ?>
                <?php
                $STOCK_MAX = $annonce->stock;
                $STOCK = 0;
                if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 1) { ?>
                    <form method="POST" action="<?= ACCUEIL ?>panier/add">
                        <select name=Quantité id=Quantité>
                            <?php
                            while ($STOCK < $STOCK_MAX) {
                                $STOCK = $STOCK + 1;
                                echo "<option value=$STOCK>$STOCK</option>";
                            }
                            ?>
                        </select>
                        <button type="submit" class="btn btn-primary" style="margin: 0px;margin-left: 0px;margin-top: 5px;margin-bottom: 10px;">Ajouter Au Panier</button>
                    </form>
                <?php }
                if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 10) { ?>
                    <form method="POST" action="<?= ACCUEIL ?>panier/add">
                        <select name=Quantité id=Quantité>
                            <?php
                            while ($STOCK < $STOCK_MAX) {
                                $STOCK = $STOCK + 1;
                                echo "<option value=$STOCK>$STOCK</option>";
                            }
                            ?>
                        </select>
                        <button type="submit" class="btn btn-primary" style="margin: 0px;margin-left: 0px;margin-top: 5px;margin-bottom: 10px;">Ajouter Au Panier</button>
                    </form>
                <?php } ?>
            </section>
            <section class="boutique_boutique_par">
                <div class="boutique">Boutique du vendeur</div>
                <div class="boutique_nom"><?= $boutique->nom ?></div>
                <div class="boutique_image">
                    <?php
                    if ($photo_boutique == false) {
                    ?>
                        <img src="../../public/img/default/18.png" alt="photo de la boutique">
                    <?php
                    } else {
                    ?>
                        <img src="../../public/img/boutique_pro/<?= $photo_boutique->photo ?>" alt="photo de la boutique">
                    <?php
                    }
                    ?>

                </div>
                <div class="type">(professionnel)</div>
                <div class="boutique_date">Créée il y a <?= depuis($boutique->create_at) ?></div>
                <div class="note">notes de la boutique</div>
                <div class="voir_boutique"><a class="btn btn-primary col-12" href="<?= ACCUEIL ?>boutiqueaccueil/pro/<?= $boutique->id ?>">Visiter</a></div>
            </section>
        </section>
    </section>
</section>
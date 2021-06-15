<?php
use function App\functions\depuis;
use App\Models\CategorieModel;
use App\Models\PhotoAnnonceModel;
var_dump($_SESSION);
require 'functions/depuis.php';
?>
<section class="main_accueil">
    <?php
        if (isset($_SESSION['success'])) : ?>
            <div class="alert alert-success text-center col-12" role="alert">
                <?php echo $_SESSION['success'];
                unset($_SESSION['success']) ?>
            </div>
        <?php
        endif;
    ?>
    <section class="search_accueil">
        <section class="container_search">
            <form class="recherche" method="POST" action="<?= ACCUEIL ?>annonce/search">
                <div class="form-group">
                    <input type="text" class="form-control" id="search" name="search" placeholder="L'Objet que Vous Recherchez">
                    <select name=categorie id=categorie>
                        <option value="0">N'Importe Quel Catégorie</option>
                        <?php
                        foreach ($categories_list as $categorie) {
                        ?>
                            <option value="<?= $categorie->id ?>"><?= $categorie->nom ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="bouton">
                    <button type="submit" class="btn btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search mb-1 mr-1" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg>
                        Recherche
                    </button>
                </div>
            </form>
        </section>
    </section>
    <h1>Annonces récentes</h1>
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
                <div class="card" style="width: 16rem;">
                    <img class="card-img-top" src="public/img/annonce/<?= $photo_annonces->photo ?>" alt="Image de l'annonce">
                    <div class="card-body">
                        <h5 class="card-title titre"><?= $annonce->titre ?></h5>
                        <p class="card-text prix">Prix: <?= $annonce->prix ?> €</p>
                        <p class="card-text categorie">Catégorie: <?= $categories->nom ?></p>
                        <p class="card-text depuis">En vente depuis <?= depuis($annonce->create_at) ?></p>
                        <?php
                        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 10 and $_SESSION['user']['boutique_id'] ==  $annonce->boutique_particulier_id) {
                            // Ceci est l'annonce de l'utilisateur connecté
                        ?>
                            <a href="<?php ACCUEIL  ?>annoncevoir/boutiquepar/<?= $annonce->id . '/' . $annonce->id ?>" class="btn btn-primary col-12">Voir l'annonce</a>
                        <?php
                        } else {
                            // Ceci n'est pas l'annonce de l'utilisateur connecté
                        ?>
                            <a href="<?php ACCUEIL  ?>annoncevoir/voirpar/<?= $annonce->id ?>" class="btn btn-primary col-12">Voir l'annonce</a>
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
                            <a href="<?php ACCUEIL  ?>annoncevoir/boutiquepro/<?= $annonce->id . '/' . $annonce->id ?>" class="btn btn-primary col-12">Voir l'annonce</a>
                        <?php
                        } else {
                            // Ceci n'est pas l'annonce de l'utilisateur connecté
                        ?>
                            <a href="<?php ACCUEIL  ?>annoncevoir/voirpro/<?= $annonce->id ?>" class="btn btn-primary col-12">Voir l'annonce</a>
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
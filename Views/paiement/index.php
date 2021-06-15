<section class="paiement_page">
    <?php
    if (isset($_POST['prix']) && !empty($_POST['prix'])) {
        require_once('vendor/autoload.php');
        $prix = (float)$_POST['prix'];

        // On instancie Stripe
        \Stripe\Stripe::setApiKey('sk_test_51IRmgEHPd5T1UddCm4ZiflsqKIjhvDoBTuvRtRhCleqr47F1N8TIxaxDVeBDIrh8rrqZDwGgfw67IW1QvpS5hY3z007YSnPFkJ');

        $intent = \Stripe\PaymentIntent::create([
            'amount' => $prix * 100,
            'currency' => 'eur'
        ]);
    } else {
        header('Location: ' . ACCUEIL);
    }
    ?>
    <section class="paiement">
        <section class="livraison">
            <h2>Adresse de livraison</h2>
            <section class="container_livraison">
                <section class="adresse">
                    <?php
                    if (isset($adresse->adresse) and !empty($adresse->adresse)) {
                    ?>
                        <address>
                            <section class="nom"> <?= ucfirst($user->nom) . ' ' . ucfirst($user->prenom) ?> </section>
                            <section class="adresse"><?= $adresse->adresse ?></section>
                            <section class="ville"><?= $adresse->code . ' ' . $adresse->ville ?></section>
                        </address>
                </section>
                <section class="adresse_modifier">
                    <a href="<?= ACCUEIL ?>user/adresse" class="btn btn-primary">Modifier mon adresse</a>
                </section>
            <?php
                    } else {
            ?>
                <adresse>
                    <a href="<?= ACCUEIL ?>user/adresse" class="btn btn-primary">Veuillez renseigner votre adresse</a>
                </adresse>
            </section>
        <?php
                    }
        ?>

        </section>
    </section>
    <section class="recapitulatif_commande">
        <h2>Récapitulatif de commande</h2>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">nom</th>
                    <th scope="col">prix unitaire</th>
                    <th scope="col">quantité</th>
                    <th scope="col">livraison</th>
                    <th scope="col">prix total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $prix_articles = 0;
                $prix_livraison = 0;
                foreach ($panier_data as $article) { ?>
                    <tr>
                        <?php
                        $prix_articles += $article->prix;
                        $prix_livraison += $article->livraison * $article->quantite;
                        ?>
                        <td> <?= $article->annonce_name ?> </td>
                        <td> <?php $prix_unitaire = $article->prix / $article->quantite;
                                echo $prix_unitaire ?> </td>
                        <td> <?= $article->quantite ?></td>
                        <td> <?= $article->livraison * $article->quantite ?></td>
                        <td> <?= $article->prix ?> </td>
                    </tr>
                <?php
                }
                ?>
            <tbody>
        </table>
        <section class="container_commande">
            <section class="commande_totale">
                <div class="prix_livraison">Livraison: <?= ' ' . $prix_livraison ?> € </div>
                <div class="prix_articles">Articles: <?= ' ' . $prix_articles ?> €</div>
                <div class="prix_total">Prix total: <?= ' ' . $prix_articles + $prix_livraison ?> €</div>
            </section>
            <section class="modifier_commande">
                <a href="<?= ACCUEIL ?>panier/view" class="btn btn-primary">Modifier ma commande</a>
            </section>
        </section>
    </section>
    <section class="card">
        <h2>Paiement par carte</h2>
        <form method="post">
            <div id="errors"></div>
            <!--Contiendra les messages d'erreur de paiement-->
            <input type="text" id="cardholder-name" placeholder="Titulaire de la carte">
            <div id="card-elements"></div>
            <!--Contiendra le formulaire de saisie des informations de carte-->
            <div id="card-errors" role="alert"></div>
            <!--Contiendra les erreurs relatives à la carte-->
            <button id="card-button" class="btn btn-primary" type="button" data-secret="<?= $intent['client_secret'] ?>">Procéder au paiement</button>
        </form>
    </section>
</section>
</section>

<script src="https://js.stripe.com/v3/"></script>
<script src="public/script.js"></script>
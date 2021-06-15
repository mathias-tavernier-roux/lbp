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
<section class="features-boxed" style="width : 100%">
    <div class="container">
        <div class="intro">
            <h2 class="text-center">Les Avantages de Notre Service</h2>
            <p class="text-center">En 3 Points</p>
        </div>
        <div class="row justify-content-center features">
            <div class="col-sm-6 col-md-5 col-lg-4 item">
                <div class="box"><i class="fa fa-shopping-cart icon"></i>
                    <h3 class="name">Systeme de Panier</h3>
                    <p class="description">Comparé au Autre Service Disponible Sur Le Marché<br />Nous Sommes Les Seuls A Fournir Un Système de Panier Digne des Boutique En Ligne d&#39;aujourd&#39;hui</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-4 item">
                <div class="box"><i class="fa fa-paypal icon"></i>
                    <h3 class="name">Création de Boutique Sur Le Service</h3>
                    <p class="description">Vous Etes Un Professionnel ou Un Particulier et Vous Vendez Des Produits, Vous Pouvez Vous Servir de Notre Plateforme Comme Site de e-commerce<br /></p>
                </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-4 item">
                <div class="box"><i class="fa fa-send icon"></i>
                    <h3 class="name">Protection du Vendeur et du Consomateur</h3>
                    <p class="description">Tout Les Achats Sont Surveillé Et Vérifié pour éviter les arnaques due a l&#39;achat en occasion</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="intro">
            <h2 class="text-center">Votre Commande D&#39;Occasion Sécurisé</h2>
            <p class="text-center">En 6 Etapes Simpliste</p>
        </div>
        <div class="row justify-content-center features">
            <div class="col-sm-6 col-md-5 col-lg-4 item">
                <div class="box"><i class="fa fa-shopping-cart icon"></i>
                    <h3 class="name">Etape 1 : Commander</h3>
                    <p class="description">Construisez Vous Un Panier Parmi Toute Les Offres Disponible Sur Le Site </p>
                </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-4 item">
                <div class="box"><i class="fa fa-paypal icon"></i>
                    <h3 class="name">Etape 2 : Paiement</h3>
                    <p class="description">Lorsque Vous Payez L&#39;Argent Ne Va Pas Directement Au Vendeur du Produit Mais a Notre Site (Le Vendeur Ne Recevra Pas Son Argent Tant Que Vous N&#39;Aurai Pas Reçu Votre Produit)</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-4 item">
                <div class="box"><i class="fa fa-send icon"></i>
                    <h3 class="name">Etape 3 : Envoi</h3>
                    <p class="description">Lors de Votre Achat, Les Vendeurs Concernés Recevront Un Document D&#39;Expédition (Avec Suivi), Cela Vous Permettra De Suivre Le Colis a la Trace</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-4 item">
                <div class="box"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-package icon">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3"></polyline>
                        <line x1="12" y1="12" x2="20" y2="7.5"></line>
                        <line x1="12" y1="12" x2="12" y2="21"></line>
                        <line x1="12" y1="12" x2="4" y2="7.5"></line>
                        <line x1="16" y1="5.25" x2="8" y2="9.75"></line>
                    </svg>
                    <h3 class="name">Etape 4 : Livraison</h3>
                    <p class="description">Lorsque Le Produit Est Livré Vous Devez Confirmer La Livraison de Votre Colis<br />Sachez Que Nous Conservons Les Suivi Pour Surveiller La Qualité de L&#39;Expedition (Erreurs) Dans Le But D&#39;Ameliorer Le Service Expedition Au Besoin</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-4 item">
                <div class="box"><i class="fa fa-money icon"></i>
                    <h3 class="name">Etape 5 : Paiement du Vendeur</h3>
                    <p class="description">Une Fois L&#39;Achat Terminé Et La Livraison Confirmé Le Vendeur Reçois Son Paiement</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-4 item">
                <div class="box"><i class="fa fa-phone icon"></i>
                    <h3 class="name">Garantie</h3>
                    <p class="description">En Cas De Pannes ou Défaillances Les Produits Ont Une Garantie (Equivalente a Celle Du Marché de L&#39;Occasion)</p>
                </div>
            </div>
        </div>
    </div>
</section>
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
            <h2 class="text-center">Les avantages de notre service</h2>
            <p class="text-center">En 3 Points</p>
        </div>
        <div class="row justify-content-center features">
            <div class="col-sm-6 col-md-5 col-lg-4 item">
                <div class="box"><i class="fa fa-shopping-cart icon"></i>
                    <h3 class="name">Systeme de panier</h3>
                    <p class="description">Comparé au autres services disponibles sur Le marché<br />Nous sommes Les seuls à fournir un système de panier digne des boutique en Ligne d&#39;aujourd&#39;hui</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-4 item">
                <div class="box"><i class="fa fa-paypal icon"></i>
                    <h3 class="name">Création de boutiques sur le site</h3>
                    <p class="description">Vous êtes un professionnel ou un particulier et vous vendez des produits, vous pouvez vous servir de notre plateforme Comme site de e-commerce<br /></p>
                </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-4 item">
                <div class="box"><i class="fa fa-send icon"></i>
                    <h3 class="name">Protection du vendeur et du consomateur</h3>
                    <p class="description">Tous les achats sont surveillés et vérifié pour éviter les arnaques due a l&#39;achat en occasion</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="intro">
            <h2 class="text-center">Votre commande d&#39;occasion sécurisé</h2>
            <p class="text-center">En 6 étapes simpliste</p>
        </div>
        <div class="row justify-content-center features">
            <div class="col-sm-6 col-md-5 col-lg-4 item">
                <div class="box"><i class="fa fa-shopping-cart icon"></i>
                    <h3 class="name">Etape 1 : Commander</h3>
                    <p class="description">Ajouter des articles à votre panier</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-4 item">
                <div class="box"><i class="fa fa-paypal icon"></i>
                    <h3 class="name">Etape 2 : Paiement</h3>
                    <p class="description">Lorsque vous payez L&#39;argent ne va pas directement au vendeur du produit mais a notre site (Le vendeur ne recevra pas son argent tant que vous N&#39;aurai pas reçu votre produit)</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-4 item">
                <div class="box"><i class="fa fa-send icon"></i>
                    <h3 class="name">Etape 3 : Envoi</h3>
                    <p class="description">Lors de votre achat, les vendeurs concernés recevront un document D&#39;expédition (avec Suivi), cela vous permettra de suivre le colis a la trace</p>
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
                    <p class="description">Lorsque le produit est livré vous devez confirmer la livraison de votre colis<br />Sachez que nous conservons les suivis pour surveiller la qualité de L&#39;expedition (erreurs) dans le but D&#39;ameliorer le service expedition au besoin</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-4 item">
                <div class="box"><i class="fa fa-money icon"></i>
                    <h3 class="name">Etape 5 : Paiement du vendeur</h3>
                    <p class="description">Une fois L&#39;achat terminé et La livraison confirmée le vendeur reçois son paiement</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-4 item">
                <div class="box"><i class="fa fa-phone icon"></i>
                    <h3 class="name">Garantie</h3>
                    <p class="description">En cas de pannes ou défaillances les produits on une garantie (équivalente a celle du marché de L&#39;occasion)</p>
                </div>
            </div>
        </div>
    </div>
</section>
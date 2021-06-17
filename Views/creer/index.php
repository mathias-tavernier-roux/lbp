<section class="creer_boutique_page">
    <h1>Créer votre boutique</h1>
    <section class="creer_boutique">
        <section class="pro">
            <a href="<?= ACCUEIL ?>boutiqueRegister/registerpro">
                <h2>Créer ma boutique en tant que professionnel</h2>
                <p>En quelques clics mettez en ligne vos annonces et profitez d'une grande visibilité.</p>
            </a>
        </section>
        <section class="par">
            <?php
            if (isset($_SESSION['user']) and !empty($_SESSION['user'])) { ?>
                <a href="<?= ACCUEIL ?>boutiqueRegister/registerpar">
                    <h2>Créer ma boutique en tant que particulier</h2>
                    <p>Rapide et simple d'utilisation. Grâce a votre boutique vous allez pouvoir mettre en vente vos articles.</p>
                </a>
            <?php
            } else { ?>
                <a href="<?= ACCUEIL ?>user/register">
                    <h2>Créer ma boutique en tant que particulier</h2>
                    <p>Pour créer une boutique en tant que particulier il faut créer un compte utilisateur et se connecter</p>
                </a>

            <?php
            }
            ?>
        </section>
    </section>
    <section class="comment">
        <a class="btn btn-primary"  href="../commentcamarche">Plus d'infos sur le fonctionnement?</a>
    </section>
</section>

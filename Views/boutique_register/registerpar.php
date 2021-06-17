<section class="register_boutique_page">
    <?php
    if (isset($_SESSION['erreur'])) {
        echo '<div class="alert alert-danger text-center" role="alert">' . $_SESSION['erreur'] . '</div>';
        unset($_SESSION['erreur']);
    }
    ?>
    <section class="register_boutique_form">
        <h1>Créez votre boutique de particulier</h1>
        <?php
        echo $boutiqueForm ?>
    </section>
</section>
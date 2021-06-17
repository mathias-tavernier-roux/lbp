<section class="modif_adresse_page">
    <?php
    if (isset($_SESSION['success'])) : ?>
        <div class="alert alert-success text-center" role="alert">
            <?php echo $_SESSION['success'];
            unset($_SESSION['success']) ?>
        </div>
    <?php endif;
    if (isset($_SESSION['erreur'])) {

        echo '<div class="alert alert-danger text-center" role="alert">' . $_SESSION['erreur'] . '</div>';
        unset($_SESSION['erreur']);
    }
    ?>
    <section class="modif_adresse_form">
        <h1>Mon adresse</h1>
        <?php
        echo $adressForm;
        ?>
    </section>
</section>
<section class="annonce_modif_page">
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
    <section class="annonce_modif_form">
        <h1>Modifier mon annonce</h1>
        <?php
        echo $form;
        ?>
    </section>
</section>
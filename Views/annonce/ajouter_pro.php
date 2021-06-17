<section class="vendre_page">
    <?php
    if (isset($_SESSION['erreur'])) {

        echo '<div class="alert alert-danger text-center" role="alert">' . $_SESSION['erreur'] . '</div>';
        unset($_SESSION['erreur']);
    }
    if (isset($_SESSION['success'])) {

        echo '<div class="alert alert-success text-center" role="alert">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['succes']);
    }
    ?>
    <section class="vendre_form">
        <h1>Publier une annonce</h1>
        <?php
        echo $form 
        ?>
    </section>
</section>
<?php
if (isset($_SESSION['erreur'])) {

    echo '<div class="alert alert-danger text-center" role="alert">' . $_SESSION['erreur'] . '</div>';
    unset($_SESSION['erreur']);
}
?>
<section class="register_page">
    <section class="register_form">
        <h1>Inscription</h1>
        <?php
        echo $registerForm;
        ?>
        <a href="login">Déjà inscrit _ Me connecter</a>
    </section>
</section>
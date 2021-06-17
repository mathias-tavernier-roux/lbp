<section class="param_boutique_pro_page">
    <?php
    if (isset($_SESSION['erreur'])) : ?>
        <div class="alert alert-danger text-center" role="alert">
            <?php echo $_SESSION['erreur'];
            unset($_SESSION['erreur']) ?>
        </div>
    <?php endif;
    if (isset($_SESSION['success'])) : ?>

        <div class="alert alert-success text-center" role="alert"><?= $_SESSION['success'] ?></div>;
    <?php unset($_SESSION['success']);
    endif;
    ?>
    <section class="param_boutique_pro_form">
        <h1>Paramètres de ma boutique</h1>
        <?php
        echo $boutiqueprofil;
        ?>
    </section>
</section>
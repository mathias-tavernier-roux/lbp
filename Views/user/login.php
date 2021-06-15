<section class="login_page">
<?php
if (isset($_SESSION['erreur'])) : ?>
  <div class="alert alert-danger text-center" role="alert">
    <?php echo $_SESSION['erreur'];
    unset($_SESSION['erreur']) ?>
  </div>
<?php endif;
if (isset($_SESSION['success'])) : ?>
  <div class="alert alert-success text-center col-12" role="alert"><?= $_SESSION['success'] ?></div>
<?php unset($_SESSION['success']);
endif;
?>
  <section class="login_form">
    <h1>Connexion</h1>
    <?php
    echo $loginForm;
    ?>
    <a href="register">M'inscrire</a>
  </section>
</section>
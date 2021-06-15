<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../../public/css/style.css">
    <link rel="stylesheet" href="public/css/Features-Boxed.css">
    <link rel="stylesheet" href="public/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="public/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="public/fonts/fontawesome5-overrides.min.css">
</head>

<body>
    <header>
        <section class="navbar navbar-expand-md navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand ml-4 " href="<?= ACCUEIL ?>">
                    Affaire conclue
                </a>
                <form method="POST" action="<?= ACCUEIL ?>annonce/search" class="form-inline navbar-search w-50 ">
                    <div class="input-group d-xl-flex">
                        <input type="text" id="search" name="search" class="bg-light form-control d-xl-inline-flex border-0 small" placeholder="Produit Recherché" />
                        <button class="btn btn-primary py-0" type="submit" style="background: rgb(111,111,111)" ;>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </button>
                    </div>
                </form>

                <!--menu burger-->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- barre nav -->
                <div class="collapse navbar-collapse mr-auto" id="navbarSupportedContent">
                    <ul class="navbar-nav nav-fill ml-auto">
                        <li class="nav-item ml-3 ">
                            <a class="nav-link" href="<?= ACCUEIL ?>commentcamarche">Comment ca marche</a>
                        </li>
                        <?php
                        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 43) { ?>
                            <li class="nav-item ml-3">
                                <a class="nav-link" href="<?= ACCUEIL ?>dashboard/moderation">Dashboard</a>
                            </li>
                        <?php }
                        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 1337) { ?>
                            <li class="nav-item ml-3">
                                <a class="nav-link" href="<?= ACCUEIL ?>dashboard/admin">Dashboard</a>
                            </li>
                        <?php }
                        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 20) { ?>
                            <li class="nav-item ml-3">
                                <a class="nav-link" href="<?= ACCUEIL ?>annonce/ajouterPro">Vends</a>
                            </li>
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle text-center" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Ma boutique
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="<?= ACCUEIL ?>boutiqueAccueil/accueilPro">Profil de ma boutique</a>
                                    <a class="dropdown-item" href="<?= ACCUEIL ?>annonce/ajouterPro">Vendre un article</a>
                                    <a class="dropdown-item" href="<?= ACCUEIL ?>boutiqueProfil/profilPro">Mes paramètres</a>
                                </div>
                            </div>
                        <?php
                        }
                        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 1) { ?>
                            <li class="nav-item ml-3 ">
                                <a class="nav-link" href="<?= ACCUEIL ?>panier/view">Mon Panier</a>
                            </li>
                            <li class="nav-item ml-3">
                                <a class="nav-link" href="<?= ACCUEIL ?>creer/index">Créer sa boutique</a>
                            </li>
                        <?php
                        }
                        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 10) { ?>
                            <li class="nav-item ml-3 ">
                                <a class="nav-link" href="<?= ACCUEIL ?>panier/view">Mon Panier</a>
                            </li>

                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle text-center ml-3" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Ma boutique
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="<?= ACCUEIL ?>boutiqueAccueil/accueilPar">Profil de ma boutique</a>
                                    <a class="dropdown-item" href="<?= ACCUEIL ?>annonce/ajouterPar">Vendre un article</a>
                                    <a class="dropdown-item" href="<?= ACCUEIL ?>boutiqueprofil/profilparticulier">Mes paramètres</a>
                                </div>
                            </div>
                            <div class="dropdown ml-3">
                                <a class="nav-link dropdown-toggle text-center" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Profil
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="<?= ACCUEIL ?>userprofil/profil">Mon profil</a>
                                    <a class="dropdown-item" href="<?= ACCUEIL ?>user/profil">Modifier mon profil</a>
                                    <a class="dropdown-item" href="<?= ACCUEIL ?>user/adresse">Mon adresse</a>
                                    <a class="dropdown-item" href="<?= ACCUEIL ?>commande/index">Mes Commandes</a>
                                </div>
                            </div>
                        <?php

                        }



                        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 1) { ?>
                            <div class="dropdown ml-3">
                                <a class="nav-link dropdown-toggle text-center" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Profil
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="<?= ACCUEIL ?>userprofil/profil">Mon profil</a>
                                    <a class="dropdown-item" href="<?= ACCUEIL ?>user/profil">Modifier mon profil</a>
                                    <a class="dropdown-item" href="<?= ACCUEIL ?>user/adresse">Mon adresse</a>
                                    <a class="dropdown-item" href="<?= ACCUEIL ?>commande/index">Mes Commandes</a>
                                </div>
                            </div>
                        <?php
                        }
                        if (isset($_SESSION['user']) and !empty($_SESSION['user']['id'])) : ?>
                            <li class="nav-item ml-3">
                                <a class="nav-link" href="<?= ACCUEIL ?>user/logout">Se déconnecter</a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item ml-3">
                                <a class="nav-link" href="<?= ACCUEIL ?>creer/index">Créer sa boutique</a>
                            </li>
                            <li class="nav-item ml-3">
                                <a class="nav-link" href="<?= ACCUEIL ?>user/register">Inscription</a>
                            </li>
                            <li class="nav-item ml-3 mr-3">
                                <a class="nav-link" href="<?= ACCUEIL ?>user/login">Connexion</a>
                            </li>

                        <?php endif;
                        ?>
                    </ul>
                </div>
            </div>
        </section>
    </header>
    <main>
        <?= $contenu ?>
    </main>
    <footer>
        <section class="logo">
            <h3>Boutique en ligne</h3>
        </section>
        <?php
        if (!isset($_SESSION['user']) and !isset($_SESSION['user']['droit'])) {
        ?>
            <section class="login">
                <div>Membres</div>
                <a href="<?= ACCUEIL ?>user/logout">Se connecter</a>
                <a href="<?= ACCUEIL ?>user/register">Inscription</a>
            </section>
            <section class="apropos">
                <div>Boutiques</div>
                <a href="<?= ACCUEIL ?>creer/index">Créer un boutique</a>
                <a href="<?= ACCUEIL ?>creer/index">Publier une annonce</a>
                <a href="<?= ACCUEIL ?>commentcamarche">Comment ca marche</a>
            </section>
        <?php
        }
        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 1) { ?>
            <section class="login">
                <div>Membres</div>
                <a href="<?= ACCUEIL ?>user/logout">Se déconnecter</a>
                <a href="<?= ACCUEIL ?>userprofil/profil">Mon profil</a>

            </section>
            <section class="apropos">
                <div>Boutiques</div>
                <a href="<?= ACCUEIL ?>creer/index">Créer un boutique</a>
                <a href="<?= ACCUEIL ?>creer/index">Publier une annonce</a>
                <a href="<?= ACCUEIL ?>commentcamarche">Comment ca marche</a>
            </section>
        <?php
        }
        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 10) {
        ?>
            <section class="login">
                <div>Membres</div>
                <a href="<?= ACCUEIL ?>user/logout">Se déconnecter</a>
                <a href="<?= ACCUEIL ?>userprofil/profil">Mon profil</a>

            </section>
            <section class="apropos">
                <div>Boutiques</div>
                <a href="<?= ACCUEIL ?>boutiqueAccueil/accueilPar">Profil de ma boutique</a>
                <a href="<?= ACCUEIL ?>annonce/ajouterPar">Vendre un article</a>
                <a href="<?= ACCUEIL ?>commentcamarche">Comment ca marche</a>
            </section>
        <?php
        }
        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 20) {
        ?>
            <section class="login">
                <div>Membres</div>
                <a href="<?= ACCUEIL ?>user/logout">Se déconnecter</a>
                <a href="<?= ACCUEIL ?>commentcamarche">Comment ca marche</a>
            </section>
            <section class="apropos">
                <div>Boutiques</div>
                <a href="<?= ACCUEIL ?>boutiqueAccueil/accueilPro">Profil de ma boutique</a>
                <a href="<?= ACCUEIL ?>annonce/ajouterPro">Vendre un article</a>
            </section>
        <?php
        }
        ?>
        <section class="social">
            <div>Retrouvez nous sur</div>
            <ul>
                <li>
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                        </svg>
                    </a>

                </li>
                <li>
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                        </svg>
                    </a>
                </li>
            </ul>
        </section>
    </footer>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy" crossorigin="anonymous"></script>
</body>

</html>
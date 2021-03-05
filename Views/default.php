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
                    Boutique en ligne
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
                        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 1 or !isset($_SESSION['user'])) { ?>
                            <li class="nav-item ml-3 ">
                                <a class="nav-link" href="<?= ACCUEIL ?>panier/view">Mon Panier</a>
                            </li>
                            <li class="nav-item ml-3">
                                <a class="nav-link" href="<?= ACCUEIL ?>creer/index">Créer sa boutique</a>
                            </li>
                            <?php
                        }
                        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 10) { ?>
                                <div class="dropdown">
                                <li class="nav-item ml-3 ">
                                        <a class="nav-link" href="<?= ACCUEIL ?>panier/view">Mon Panier</a>
                                    </li>
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
                                        <a class="dropdown-item" href="<?= ACCUEIL ?>boutiqueProfil/profilPro">Moyen de paiement</a>
                                    </div>
                                </div>
                            <?php

                        }



                        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 1) { ?>
                                <div <div class="dropdown ml-3">
                                    <a class="nav-link dropdown-toggle text-center" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Profil
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="<?= ACCUEIL ?>userprofil/profil">Mon profil</a>
                                        <a class="dropdown-item" href="<?= ACCUEIL ?>user/profil">Modifier mon profil</a>
                                        <a class="dropdown-item" href="<?= ACCUEIL ?>user/adresse">Mon adresse</a>
                                        <a class="dropdown-item" href="<?= ACCUEIL ?>boutiqueProfil/profilPro">Moyen de paiement</a>
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





    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy" crossorigin="anonymous"></script>
</body>

</html>
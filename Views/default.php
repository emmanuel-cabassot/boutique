<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>
    <header>
        <section class="navbar navbar-expand-md navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand ml-4 " href="<?= ACCUEIL ?>">
                    Boutique en ligne
                </a>

                <!--menu burger-->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- barre nav -->
                <div class="collapse navbar-collapse mr-auto" id="navbarSupportedContent">
                    <ul class="navbar-nav nav-fill ml-auto">
                        <li class="nav-item ml-3 ">
                            <a class="nav-link" href="<?= ACCUEIL ?>annonce">Annonces</a>
                        </li>
                        <?php
                        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 20 ) { ?>
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
                                    <a class="dropdown-item" href="#">Mes paramètres</a>
                                </div>
                            </div>
                        <?php
                        }
                        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 1 or !isset($_SESSION['user'])) { ?>
                            <li class="nav-item ml-3">
                                <a class="nav-link" href="<?= ACCUEIL ?>creer/index">Créer sa boutique</a>
                            </li>
                        <?php
                        }
                        if (isset($_SESSION['user']['droit']) AND $_SESSION['user']['droit'] == 10) { ?>
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle text-center" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Ma boutique
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="<?= ACCUEIL ?>boutiqueAccueil/accueilPar">Profil de ma boutique</a>
                                    <a class="dropdown-item" href="<?= ACCUEIL ?>annonce/ajouterPar">Vendre un article</a>
                                    <a class="dropdown-item" href="#">Mes paramètres</a>
                                </div>
                            </div>
                        <?php
                        }



                        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 1) { ?>
                            <li class="nav-item ml-3">
                                <a class="nav-link" href="<?= ACCUEIL ?>user/profil">Profil</a>
                            </li>
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
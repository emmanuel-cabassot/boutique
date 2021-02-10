<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
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
                        <a class="nav-link" href="<?= ACCUEIL ?>annonces">Annonces</a>
                    </li>
                    <?php
                    if (isset($_SESSION['user']) AND !empty($_SESSION['user']['id'])): ?>
                        <li class="nav-item ml-3">
                            <a class="nav-link" href="<?= ACCUEIL ?>users/profil" >Profil</a>
                        </li>
                        <li class="nav-item ml-3">
                            <a class="nav-link" href="<?= ACCUEIL ?>users/logout" >Se déconnecter</a>
                        </li>
                        <li class="nav-item ml-3">
                            <a class="nav-link" href="<?= ACCUEIL ?>annonces/ajouter" >Creer annonce</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item ml-3">
                            <a class="nav-link" href="<?= ACCUEIL ?>boutiques/register">Créer boutique</a>
                        </li>
                        <li class="nav-item ml-3">
                            <a class="nav-link" href="<?= ACCUEIL ?>users/register">Inscription</a>
                        </li>
                        <li class="nav-item ml-3 mr-3">
                            <a class="nav-link" href="<?= ACCUEIL ?>users/login" >Connexion</a>
                        </li>
                        
                    <?php endif;
                    ?>                  
                </ul>
            </div>
        </div>
    </section>
    </header>
    <main class="container">
        <?= $contenu ?>
    </main>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>
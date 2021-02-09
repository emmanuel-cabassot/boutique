<h1>Page d'accueil du site</h1>
<?php 
if (isset($_SESSION['erreur'])) {

    echo '<div class="alert alert-danger text-center" role="alert">'. $_SESSION['erreur'].'</div>';
    unset($_SESSION['erreur']);
}
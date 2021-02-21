<?php

use function App\functions\depuis;


if (isset($_SESSION['erreur'])) {

    echo '<div class="alert alert-danger text-center" role="alert">' . $_SESSION['erreur'] . '</div>';
    unset($_SESSION['erreur']);
}
if (isset($_SESSION['success'])) {

    echo '<div class="alert alert-success text-center" role="alert">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
}
require 'functions/depuis.php';
?>
<section class="boutique_par_container">
    <section class="boutique_par">
        <section class="photo_container">
            <img src="../../../public/img/annonce/<?= $photo->photo ?>" alt="photo de l'annonce">
        </section>
        <section class="description_container">
            <section class="description_boutique_par">
                <div class="titre"><?= $annonce->titre ?></div>
                <div class="description"><?= $annonce->description ?></div>
                <div class="prix"><?= $annonce->prix ?> €</div>
                <div class="livraison">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-truck text-info mb-1" viewBox="0 0 16 16">
                        <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                    </svg>
                    <?= $livraison->prix ?> €
                </div>
                <div class="date_annonce">publiée il y a <?= depuis($annonce->create_at) ?></div>
                <div class="ajouter_panier"><a class="btn btn-info text_white col-12" href="">Ajouter au panier</a></div>
                <div class="favoris"><a class="btn btn-light col-12" href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-heart text-secondary mr-1 " viewBox="0 0 16 16">
                            <path d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                        </svg>
                        Favoris
                    </a>
                </div>
            </section>
            <section class="boutique_boutique_par">
                <div class="boutique">Boutique du vendeur</div>
                <div class="boutique_nom"><?= $boutique->nom ?></div>
                <div class="boutique_image">
                    <?php
                        if ($photo_boutique == false) {
                            ?>
                            <img src="../../../public/img/default/18.png" alt="photo de la boutique">
                            <?php
                        }else {
                            ?>
                            <img src="../../../public/img/boutique_pro/<?= $photo_boutique->photo ?>" alt="photo de la boutique">
                            <?php
                        }
                    ?>
                    
                </div>
                <div class="type">(professionnel)</div>
                <div class="boutique_date">Créée il y a <?= depuis($boutique->create_at) ?></div>
                <div class="note">notes de la boutique</div>
                <div class="voir_boutique"><a class="btn btn-primary col-12" href="<?= ACCUEIL ?>boutiqueaccueil/accueilpro">Visiter</a></div>
            </section>
        </section>
    </section>
</section>
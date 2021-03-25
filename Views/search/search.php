<center>
    <h1>Resultats de la Recherche</h1>
</center>
<?php

use App\Models\PhotoAnnonceModel;

$photo_annonce = new PhotoAnnonceModel;
foreach ($annonces as $annonce) {
    if ($annonce->boutique_pro_id == null) {
       /*  var_dump($annonce); die; */
        // Boutique de particulier
        $photo_annonces = $photo_annonce->findPhotoByAnnonceId($annonce->id);
?>
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="../public/img/annonce/<?= $photo_annonces->photo ?>" alt="Image de l'annonce">
            <div class="card-body">
                <h5 class="card-title"><?= $annonce->titre ?></h5>
                <p class="card-text"><?= $annonce->description ?></p>
                <p class="card-text"><?= $annonce->prix ?> €</p>
                <?php
                if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 10 and $_SESSION['user']['boutique_id'] ==  $annonce->boutique_particulier_id) {
                    // Ceci est l'annonce de l'utilisateur connecté
                ?>
                    <a href="<?php ACCUEIL ?>../annoncevoir/boutiquepar/<?= $annonce->id . '/' . $annonce->id ?>" class="btn btn-primary col-12">Voir l'annonce</a>
                <?php
                } else {
                    // Ceci n'est pas l'annonce de l'utilisateur connecté
                ?>
                    <a href="<?php ACCUEIL ?>../annoncevoir/voirpar/<?= $annonce->id ?>" class="btn btn-primary col-12">Voir l'annonce</a>
                <?php
                }
                ?>

            </div>
        </div>
    <?php
    } else {
        // Boutique de professionnel
        $photo_annonces = $photo_annonce->findPhotoByAnnonceId($annonce->id);
    ?>
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="../public/img/annonce/<?= $photo_annonces->photo ?>" alt="Image de l'annonce">
            <div class="card-body">
                <h5 class="card-title"><?= $annonce->titre ?></h5>
                <p class="card-text"><?= $annonce->description ?></p>
                <p class="card-text"><?= $annonce->prix ?> €</p>
                <?php
                if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 20 and $_SESSION['user']['id'] ==  $annonce->boutique_pro_id) {
                    // Ceci est l'annonce de l'utilisateur connecté
                ?>
                    <a href="<?php ACCUEIL  ?>../annoncevoir/boutiquepro/<?= $annonce->id . '/' . $annonce->id ?>" class="btn btn-primary col-12">Voir l'annonce</a>
                <?php
                } else {
                    // Ceci n'est pas l'annonce de l'utilisateur connecté
                ?>
                    <a href="<?php ACCUEIL  ?>../annoncevoir/voirpro/<?= $annonce->id ?>" class="btn btn-primary col-12">Voir l'annonce</a>
                <?php
                }
                ?>
            </div>
        </div>
<?php
    }
} ?>
<?php

use App\Models\PhotoAnnonceModel;

if (isset($_SESSION['erreur'])) {

    echo '<div class="alert alert-danger text-center" role="alert">' . $_SESSION['erreur'] . '</div>';
    unset($_SESSION['erreur']);
}
if (isset($_SESSION['success'])) {

    echo '<div class="alert alert-success text-center" role="alert">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
}
?>
<section class="boutique_accueil">
    <section class="profil">
        <section class="avatar">
            <?php
            if (empty($photo)) { ?>
                <img src="../public\img\default\boutique.jpg" alt="boutique">
            <?php
            } else { ?>
                <img src="../public\img\boutique_par\<?= $photo->photo ?>" alt="photo de la boutique pro">
            <?php
            }
            ?>
            <p><?= ucfirst($boutique->nom_boutique) ?></p>
        </section>
        <section class="note">
            <?php
            if (isset($note)) {
                echo "note";
            } else {
                echo "5 étoiles";
            }
            ?>
        </section>
        <section class="modifier">
            <a class="btn btn-primary col-12" href="<?= ACCUEIL ?>boutiqueprofil/profilparticulier">Modifier son profil</a>
        </section>
    </section>
    <section class="annonces">
        <?php
        $photo_annonce = new PhotoAnnonceModel;
        if (isset($annonce) and !empty($annonce)) {
            foreach ($annonce as $annonces) { ?>
                <section class="annonce">
                    <a href="<?= ACCUEIL ?>annonceVoir/boutiquePar/<?= $boutique->id ?>/<?= $annonces->id?>">
                        <section class="photo">
                            <?php 
                            $photo_annonces = $photo_annonce->findPhotoByAnnonceId($annonces->id);
                            ?>           
                            <img src="../public/img/annonce/<?= $photo_annonces->photo ?>" alt="photo principale de l'annonce">
                        </section>
                        <section class="description">
                            <div class="titre"><?= $annonces->titre ?></div>
                            <div class="prix"><?= $annonces->prix ?> €</div>
                        </section>
                    </a>
                </section>
            <?php
            }
        } else { ?>
            <p>Pas d'annonces publiées</p>
        <?php
        } ?>
    </section>
</section>
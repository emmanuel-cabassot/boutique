<h1>Boutique de particulier</h1>
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
            if ($photo_boutique == false) { ?>
                <img src="../../public\img\default\18.png" alt="photo de la boutique par default">
            <?php
            } else { ?>
                <img src="../../public\img\boutique_par\<?= $photo_boutique->photo ?>" alt="photo de la boutique de particulier">
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
            <a class="btn btn-primary col-12" href="<?= ACCUEIL ?>boutiqueprofil/profilparticulier">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                    <path d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                </svg> 
                Favoris
            </a>
        </section>
    </section>
    <section class="annonces">
        <?php
        $photo_annonce = new PhotoAnnonceModel;
        if (isset($annonce) and !empty($annonce)) {
            foreach ($annonce as $annonces) { ?>
                <section class="annonce">
                    <a href="<?= ACCUEIL ?>annonceVoir/voirpar/<?= $annonces->id ?>">
                        <section class="photo">
                            <?php
                            $photo_annonces = $photo_annonce->findPhotoByAnnonceId($annonces->id);
                            ?>
                            <img src="../../public/img/annonce/<?= $photo_annonces->photo ?>" alt="photo principale de l'annonce">
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
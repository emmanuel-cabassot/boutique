<?php
if (isset($_SESSION['erreur'])) {

    echo '<div class="alert alert-danger text-center" role="alert">'. $_SESSION['erreur'].'</div>';
    unset($_SESSION['erreur']);
}
if (isset($_SESSION['success'])) {

    echo '<div class="alert alert-success text-center" role="alert">'. $_SESSION['success'].'</div>';
    unset($_SESSION['success']);
}
?>
<section class="boutique_accueil">
    <section class="profil">
        <section class="avatar">
            <img src="../public\img\avatar\boutique.jpg" alt="boutique">
            <p><?= $boutique->nom ?></p>
        </section>
        <section class="note">
            <?php
            if (isset($note)) {
                echo "note";
            }else {
                echo "5 étoiles";
            }
            ?>
        </section>
        <section class="modifier">
            <a  class="btn btn-primary col-12" href="">Modifier son profil</a>
        </section>
    </section>
    <section class="annonces">
        <?php
        if (isset($annonce)) {?>        
            <?php
             foreach ($annonce as $annonces) {?>
            <a href="">
            <?= $annonces->titre ?>
            </a>
            <?php
            }         
        }else {?>
            <h2>Annonces de la boutique</h2>
            <p>Pas d'annonces publiées</p>
            <?php
        }?>
    </section>
</section>
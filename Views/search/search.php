<center><h1>Resultats de la Recherche</h1></center>
<?php
foreach ($annonces as $annonce) :
    if ($annonce->boutique_pro_id == null) {
        ?>
        <article>
            <h2><a href="../annoncevoir/voirpar/<?= $annonce->id ?>"><?= $annonce->titre ?></a></h2>
            <p><?= $annonce->description ?></p>
        </article>
        <?php
    }else {
        ?>
        <article>
            <h2><a href="../annoncevoir/voirpro/<?= $annonce->id ?>"><?= $annonce->titre ?></a></h2>
            <p><?= $annonce->description ?></p>
        </article>
        <?php
    }
   

 endforeach 
 ?>

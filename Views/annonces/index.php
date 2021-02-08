<h1>Page d'accueil des annonces</h1>
<?php
if(isset($_SESSION['success'])): ?>
    <div class="alert alert-success text-center" role="alert">
        <?php echo $_SESSION['success']; unset($_SESSION['success']) ?>
    </div> 
<?php endif;

foreach ($annonces as $annonce): ?>
<article>
    <h2><a href="annonces/voir/<?=$annonce->id?>"><?=$annonce->titre?></a></h2>
    <p><?=$annonce->description?></p>
</article>
<?php endforeach ?>
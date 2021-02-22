<h1 class="text-center">Créez votre boutique pro</h1>
<?php
if (isset($_SESSION['erreur'])) {

echo '<div class="alert alert-danger text-center" role="alert">'. $_SESSION['erreur'].'</div>';
unset($_SESSION['erreur']);
}
 echo $boutiqueForm ?>
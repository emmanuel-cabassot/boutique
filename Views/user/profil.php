<h1>Modifier votre profil</h1>

<?php
if(isset($_SESSION['success'])): ?>
<div class="alert alert-success text-center" role="alert">
  <?php echo $_SESSION['success']; unset($_SESSION['success']) ?>
</div>
<?php endif; 
if (isset($_SESSION['erreur'])) {

  echo '<div class="alert alert-danger text-center" role="alert">'. $_SESSION['erreur'].'</div>';
  unset($_SESSION['erreur']);
}
echo $profilForm;?>
<h2>Adresse</h2>
<?php
echo $adressForm;
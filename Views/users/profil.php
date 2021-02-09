<h1>Modifier votre profil</h1>

<?php
if(isset($_SESSION['success'])): ?>
<div class="alert alert-success text-center" role="alert">
  <?php echo $_SESSION['success']; unset($_SESSION['success']) ?>
</div>
<?php endif; 
echo $profilForm;

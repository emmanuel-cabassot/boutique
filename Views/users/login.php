<h1>Connection</h1>
<?php
if(isset($_SESSION['erreur'])): ?>
  <div class="alert alert-danger text-center" role="alert">
    <?php echo $_SESSION['erreur']; unset($_SESSION['erreur']) ?>
  </div>
<?php endif; 
  echo $loginForm;
?>
<a href="register">M'inscrire</a>







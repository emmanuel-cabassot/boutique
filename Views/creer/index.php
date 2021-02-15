<h1>Créer sa boutique</h1>

<div><a href="<?= ACCUEIL ?>boutiqueRegister/registerpro">Créer ma boutique pro</a></div>

<?php
if (isset($_SESSION['user']) AND !empty($_SESSION['user'])) { ?>
    <div><a href="<?= ACCUEIL ?>boutiqueRegister/registerpar">Créer ma boutique en tant que particulier </a></div>
    <?php
}else {?>
    <h2>Pour créer une boutique en tant que particulier il faut créer un compte utilisateur et se connecter</h2>
    <div><a href="<?= ACCUEIL ?>user/register">Inscription</a></div>
    <div><a href="<?= ACCUEIL ?>user/login">Connexion</a></div>
<?php
}

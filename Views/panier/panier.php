<h1>Mon Panier</h1>
<p>Certains Article Stocké Peuvent avoir etre modifié voir supprimé si le stock des article concerné a changé ou si les articles concerné ont été modifié</p>
<?php
$panier_total = 0;
if (empty($panier_data))
{
echo "<h2>Votre Panier Est Vide</h2>";
}
if (!empty($panier_data))
{
?><table class="table" border="1">
<tr><th>Nom du Produit</th><th>Nom du Vendeur</th><th>Quantité</th><th>Prix</th><th>
<?php
foreach ($panier_data as $panier)
{
echo "<tr><td>$panier->annonce_name</td><td>$panier->vendor_name</td><td>$panier->quantite</td><td>$panier->prix</td></tr>";
$panier_total = $panier_total + $panier->prix;
$_SESSION['produit_q'][$panier->annonce_id] = $panier->quantite;
$_SESSION['produit_p'][$panier->annonce_id] = $panier->prix / $panier->quantite;
}
?>
</table>
<?php
echo "Total a Payer (Livraison Inclus) : $panier_total Euros</br>";
echo "En Achetant Ces Produits Vous Acceptez Les Conditions Générales D'Utilisation</br>"
?>
<div class="container" style="margin: 0px;margin-top: 18px;">
<center><h2>Gestion du Panier</h2></center>
    <div class="row">
        <div class="col-md-4 align-self-center text-center">
        <h3>Supprimer Un Article</h3></center>
            <form method="POST" action="<?= ACCUEIL ?>panier/del">
                <select name=Produit id=Produit>
                <?php 
                foreach ($panier_data as $panier)
                {
                    echo "<option value=$panier->annonce_id>$panier->annonce_name</option>";
                }
                ?>
                </select>
                <button type="submit" class="btn btn-primary" style="margin: 0px;margin-left: 0px;margin-top: 5px;margin-bottom: 10px;">Supprimer L'Article</button>
            </form>
            <h4>ATTENTION : Cette Action Est Irréversible</h4></center>
        </div>
        <div class="col-md-4 align-self-center text-center">
        <center><h3>Modifier la Quantité</h3></center>
            <form method="POST" action="<?= ACCUEIL ?>panier/edit">
                <select name=Produit id=Produit>
                <?php
                foreach ($panier_data as $panier)
                {
                    echo "<option value=$panier->annonce_id>$panier->annonce_name</option>";
                }
                ?>
                </select>
                <select name=EDIT id=EDIT>
                <option value="+">+1</option>
                <option value="-">-1</option>
                </select>
                <button type="submit" class="btn btn-primary" style="margin: 0px;margin-left: 0px;margin-top: 5px;margin-bottom: 10px;">Modifier L'Article</button>
            </form>
            <h4>L'Operation Echouera Si Le Stock Du Vendeur Est Insuffisant</h4></center>
        </div>
        <div class="col-md-4 align-self-center text-center">
            <h3>Effacer Tout Le Panier</h3>
            <form method="POST" action="<?= ACCUEIL ?>panier/delAll">
            <button type="submit" class="btn btn-primary" style="margin: 0px;margin-left: 0px;margin-top: 5px;margin-bottom: 10px;">Nettoyer Le Panier</button>
            </form>
            <h4>ATTENTION : Cette Action Est Irréversible</h4></center>
        </div>
    </div>
</div>
<?php
}
?>

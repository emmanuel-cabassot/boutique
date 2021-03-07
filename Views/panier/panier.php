<h1>Mon Panier</h1>
<p>Certains Article Stocké Peuvent avoir etre modifié voir caché si le stock des article concerné a changé ou si les articles concerné ont été modifié / effacé</p>
<?php
$panier_total = 0;
if (empty($panier_data)) {
    echo "<h2>Votre Panier Est Vide</h2>";
}
if (!empty($panier_data)) {
?><table class="table">
        <tr>
            <th>Nom du Produit</th>
            <th>Nom du Vendeur</th>
            <th>Quantité</th>
            <th>Prix</th>
            <th>Cout Livraison</th>
            <th></th>
            <th></th>
        </tr>
        <?php
        foreach ($panier_data as $panier) 
        {
            $request1 = "SELECT `stock` , `prix`  FROM `annonce` WHERE `id` = $panier->annonce_id";
            $request2 = "SELECT `livraison` FROM `panier` WHERE `annonce_id` = $panier->annonce_id";
            $dbs = mysqli_connect("localhost", "root", "", "boutique");
            $query1 = mysqli_query($dbs, $request1);
            $result1 = mysqli_fetch_assoc($query1);
            $query2 = mysqli_query($dbs, $request2);
            $result2 = mysqli_fetch_assoc($query2);
            if ($result1['stock'] < $panier->quantite)
            {      
                $quantité = $result1['stock'];
                $nprix = $result1['prix'];
                $nprix = $nprix * $quantité;
                $livraison = $result2['livraison'] * $quantité;
                $USER_TARGET = $_SESSION['user']['id'];
                $request = "UPDATE `panier` SET `quantite`= $quantité,`prix`= $nprix WHERE `annonce_id` = $panier->annonce_id && `user_id` = $USER_TARGET";
                $dbs = mysqli_connect("localhost", "root", "", "boutique");
                $query = mysqli_query($dbs, $request);
            }
            else
            {
                $quantité = $panier->quantite;
                $nprix = $result1['prix'];
                $nprix = $nprix * $quantité;
                $livraison = $result2['livraison'] * $quantité;
                $USER_TARGET = $_SESSION['user']['id'];
                $request = "UPDATE `panier` SET `quantite`= $quantité,`prix`= $nprix WHERE `annonce_id` = $panier->annonce_id && `user_id` = $USER_TARGET";
                $dbs = mysqli_connect("localhost", "root", "", "boutique");
                $query = mysqli_query($dbs, $request);
            }
            if ($quantité == 0)
            {

            }
            else
            { 
        ?>
            <tr>
                <td><?= $panier->annonce_name ?></td>
                <td><?= $panier->vendor_name ?></td>
                <td><?= $quantité ?></td>
                <td><?= $nprix ?></td>
                <td><?= $livraison ?></td>
                <td>
                    <form method="POST" action="<?= ACCUEIL ?>panier/edit">
                        <input style=display:none name=Produit id=Produit value=<?= $panier->annonce_id ?>></input>
                        <select name=EDIT id=EDIT>
                            <option value="+">+1</option>
                            <option value="-">-1</option>
                        </select>
                        <button type="submit" class="btn btn-primary" style="margin: 0px;margin-left: 0px;margin-top: 5px;margin-bottom: 10px;">Modifier La Quantité</button>
                    </form>
                </td>
                <td>
                    <form method="POST" action="<?= ACCUEIL ?>panier/del">
                        <input style=display:none name=Produit id=Produit value=<?= $panier->annonce_id ?>></input>
                        <button type="submit" class="btn btn-primary" style="margin: 0px;margin-left: 0px;margin-top: 5px;margin-bottom: 10px;">Supprimer L'Article</button>
                    </form>
                </td>
            </tr>
        <?php
            $panier_total = $panier_total + $nprix + $livraison;
        }
    }
        ?>
    </table>
    <p class="panier-p">Total a Payer (Livraison Inclus) : <b><?=$panier_total?> Euros</b></p></br>
                    <form method="POST" action="<?= ACCUEIL ?>paiement">
                        <input style=display:none name=prix id=prix value=<?= $panier_total ?>></input>
                        <button type="submit" class="btn btn-primary" style="margin: 0px;margin-left: 0px;margin-top: 0px;margin-bottom: 50px;">Passer la Commande</button>
                    </form>
    <div class="container" style="margin: 0px;margin-top: 0px align-self-center text-center;">
        <div class="align-self-center text-center">
            <h3>Effacer Tout Le Panier</h3>
            <form method="POST" action="<?= ACCUEIL ?>panier/delAll">
                <button type="submit" class="btn btn-primary" style="margin: 0px;margin-left: 0px;margin-top: 5px;margin-bottom: 10px;">Nettoyer Le Panier</button>
            </form>
        </div>
    </div>
<?php
}
?>
<?php
namespace App\Controllers;

use App\Models\AdresseProModel;
use App\Models\AnnonceModel;
use App\Models\BoutiqueProModel;

class BoutiqueAccueilController extends Controller
{
    public function accueilPro()
    {
        if (isset($_SESSION['user']) AND $_SESSION['user']['droit'] == 20) {
            (int) $id = $_SESSION['user']['id'];
            $boutique = new BoutiqueProModel;
            $boutique = $boutique->find($id);
            var_dump($boutique);
            $adresse = new AdresseProModel;
            $adresse = $adresse->findAdresse($id);
            var_dump($adresse);
            $annonce = new AnnonceModel;
            $annonce = $annonce->findAnnoneProLimit($id);
            var_dump($annonce);
            


            $this->render('boutique_accueil/accueil_pro', ['boutique' => $boutique, 'adresse' => $adresse, 'annonce' => $annonce]);
        }else {
            $_SESSION['erreur'] = "Vous n'avez pas les accès pour cette page";
            header('location: '.ACCUEIL);
        }
        
    }
}
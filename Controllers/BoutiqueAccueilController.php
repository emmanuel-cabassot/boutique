<?php
namespace App\Controllers;

use App\Models\AdresseParticulierModel;
use App\Models\AdresseProModel;
use App\Models\AnnonceModel;
use App\Models\BoutiqueParticulierModel;
use App\Models\BoutiqueProModel;
use App\Models\PhotoAvatarModel;

class BoutiqueAccueilController extends Controller
{
    /**
     * Affiche le profil de la boutique pro
     *
     * @return void
     */
    public function accueilPro()
    {
        if (isset($_SESSION['user']) AND $_SESSION['user']['droit'] == 20) {
            
            (int) $id = $_SESSION['user']['id'];
            $photo = new PhotoAvatarModel;
            $photo = $photo->findPhotoBoutique($_SESSION['user']['id']);
            
            $boutique = new BoutiqueProModel;
            $boutique = $boutique->find($id);
   
            $adresse = new AdresseProModel;
            $adresse = $adresse->findAdresse($id);
            
            $annonce = new AnnonceModel;
            $annonce = $annonce->findAnnoneProLimit($id);
            
            $this->render('boutique_accueil/accueil_pro', ['boutique' => $boutique, 'adresse' => $adresse, 'annonce' => $annonce, 'photo' => $photo]);
        }else {
            $_SESSION['erreur'] = "Vous n'avez pas les accès pour cette page";
            header('location: '.ACCUEIL);
        }
        
    }

    /**
     * Affiche le profil de la boutique de particulier
     *
     * @return void
     */
    public function accueilPar()
    {
        if (isset($_SESSION['user']) AND $_SESSION['user']['droit'] = 10) {
            
            (int) $id = $_SESSION['user']['id'];
            $photo = new PhotoAvatarModel;
            $photo = $photo->findPhotoBoutiquePar($_SESSION['user']['boutique_id']);
            
            $boutique = new BoutiqueParticulierModel;
            $boutique = $boutique->findBoutiqueByUser($id);
            
   
            $adresse = new AdresseParticulierModel;
            $adresse = $adresse->findAdresse($id);
            
            
            $annonce = new AnnonceModel;
            $annonce = $annonce->findAnnonceParLimit($boutique->id);

            

            
            
            $this->render('boutique_accueil/accueil_par', ['boutique' => $boutique, 'adresse' => $adresse, 'annonce' => $annonce, 'photo' => $photo]);
        }else {
            $_SESSION['erreur'] = "Vous n'avez pas les accès pour cette page";
            header('location: '.ACCUEIL);
        }
        
    }
}
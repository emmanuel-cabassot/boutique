<?php
namespace App\Controllers;

use App\Models\AnnonceModel;
use App\Models\BoutiqueParticulierModel;
use App\Models\CategorieModel;
use App\Models\PhotoAnnonceModel;

class AnnonceVoirController extends Controller
{
   /**
    * Permet a une boutique de particulier de voir son annonce
    *
    * @param int $annonce_id Id de l'annonce
    * @return void
    */
   public function boutiquePar($boutique_id, $annonce_id )
   {
        if ($boutique_id = $_SESSION['user']['boutique_id']) {          
            // On instancie la classe annonceModel et et on recherche une annonce par rapport à son id
            $annonces = new AnnonceModel();
            $annonce = $annonces->findAnnonceByPar($annonce_id);
            var_dump($annonce); die;

            // On instancie la classe PhotoAnnonceModel et et on recherche une photo par rapport à  id photo
            $photos = new PhotoAnnonceModel();
            $photo = $photos->findPhotoByAnnonceId($annonce_id);

            // On instancie la classe BoutiqueParticulierModel et on recherche une boutique par rapport à boutique_id
            $boutiques = new BoutiqueParticulierModel();
            $boutique = $boutiques->findBoutiqueById($boutique_id);

            $categorie_id = $annonce->categorie_id;
            var_dump($categorie_id);die;

            // On instancie la classe CategorieModel et on recherche la categorie de l'article par rapport à son categorie_id
            $categories = new CategorieModel();
            $categorie = $categories->findByIdCategorie($categorie_id);


           

            $this->render('annonce_voir/boutique_par', ['annonce' => $annonce, 'photo' => $photo, 'boutique' => $boutique, 'categorie' => $categorie]);

        }else {
            $_SESSION['erreur'] = "Vous n'avez pas accès à cette page";
            header('location: ' .ACCUEIL);
            exit;
        }
        




   } 

   public function monAnnone()
   {

   }
}
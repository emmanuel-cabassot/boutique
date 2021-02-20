<?php
namespace App\Controllers;


use App\Models\AnnonceModel;
use App\Models\BoutiqueParticulierModel;
use App\Models\CategorieModel;
use App\Models\LivraisonModel;
use App\Models\PhotoAnnonceModel;
use App\Models\PhotoAvatarModel;


class AnnonceVoirController extends Controller
{
   /**
    * Permet a une boutique de particulier de voir son annonce
    *
    * @param int $annonce_id Id de l'annonce
    * @return void
    */
   public function boutiquePar($boutique_id, $id_annonce )
   {
        if ($boutique_id = $_SESSION['user']['boutique_id']) {          
            // On instancie la classe annonceModel et et on recherche une annonce par rapport à son id
            $annonces = new AnnonceModel();
            $annonce = $annonces->find($id_annonce);

            // On instancie la classe LivraisonModel et on recupere le prix de la livraison par rapport au poid de l'annonce
            $livraisons = new LivraisonModel;
            $livraison = $livraisons->prixLivraison($annonce->poids);

            // On instancie la classe PhotoAnnonceModel et et on recherche une photo par rapport à  id photo
            $photos = new PhotoAnnonceModel();
            $photo = $photos->findPhotoByAnnonceId($id_annonce);
            

            // On instancie la classe BoutiqueParticulierModel et on recherche une boutique par rapport à boutique_id
            $boutiques = new BoutiqueParticulierModel();
            $boutique = $boutiques->findBoutiqueById($boutique_id);
            
            $categorie_id = $annonce->categorie_id;
           

            // On instancie la classe CategorieModel et on recherche la categorie de l'article par rapport à son categorie_id
            $categories = new CategorieModel();
            $categorie = $categories->findByIdCategorie($categorie_id);

            // On instancie la classe PhotoAvatar et on recherche la photo de la boutique de particulier
            $photo_boutiques = new PhotoAvatarModel();
            $photo_boutique = $photo_boutiques->findPhotoBoutiquePar($boutique_id);

            $this->render('annonce_voir/boutique_par', ['annonce' => $annonce, 'livraison' => $livraison, 'photo' => $photo, 'boutique' => $boutique, 'categorie' => $categorie, 'photo_boutique' => $photo_boutique]);

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
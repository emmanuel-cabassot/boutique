<?php
namespace App\Controllers;

use App\Models\AnnoncesModel;

class AnnoncesController extends Controller
{
    /**
     * Cette méhode affichera une page listant toutes les annonces de la BDD
     *
     * @return void
     */
    public function index()
    {
        // On instancie le class correspondant à la table annonces
        $annonce = new AnnoncesModel;
        // On appelle la méthode findAll qui va enregistrer les annonces dans $annonces
        $annonces = $annonce->findAll();
        
        // On génère la vue
        $this->render('annonces/index', compact('annonces'));
    }

    /**
     * Affiche 1 annonce
     *
     * @param [type] $id
     * @return void
     */
    public function lire(int $id)
    {
        $annonce = new AnnoncesModel;
        $annonces = $annonce->find($id);
        
        $this->render('annonces/lire', compact('annonces'));
    }
}
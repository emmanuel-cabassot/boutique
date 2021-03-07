<?php
namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\AdresseParticulierModel;
use App\Models\PanierModel;
use App\Models\UserModel;

class PaiementController extends Controller
{
    public function index()
    {
        
        $user = new UserModel;
        $user = $user->find($_SESSION['user']['id']);
        $adresse = new AdresseParticulierModel;
        $adresse = $adresse->findAdresse($_SESSION['user']['id']);
        // On instancie le class correspondant à la table annonces
        $panier = new PanierModel;
        // On appelle la méthode search qui va rechercher les annonces pertinante dans la base de données
        $panier_data = $panier->view();
        

        $this->render('paiement/index', ['panier_data' => $panier_data, 'user' => $user, 'adresse' => $adresse]);
    }
}
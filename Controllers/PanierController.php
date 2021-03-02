<?php
namespace App\Controllers;
use App\Models\PanierModel;
class PanierController extends Controller
{
public function view()
    {
        // On instancie le class correspondant à la table annonces
        $panier = new PanierModel;
        // On appelle la méthode search qui va rechercher les annonces pertinante dans la base de données
        $panier_data = $panier->view();
        // On génère la vue
        $this->render('panier/panier', compact('panier_data'));
    }

public function add()
    {
        // On instancie le class correspondant à la table annonces
        $panier = new PanierModel;
        // On appelle la méthode search qui va rechercher les annonces pertinante dans la base de données
        $panier_data = $panier->add();
        // On génère la vue
        $this->render('panier/add', compact('panier_data'));
    }

    public function edit()
    {
        // On instancie le class correspondant à la table annonces
        $panier = new PanierModel;
        // On appelle la méthode search qui va rechercher les annonces pertinante dans la base de données
        $panier_data = $panier->edit();
        // On génère la vue
        $this->render('panier/edit', compact('panier_data'));
    }

    public function del()
    {
        // On instancie le class correspondant à la table annonces
        $panier = new PanierModel;
        // On appelle la méthode search qui va rechercher les annonces pertinante dans la base de données
        $panier_data = $panier->del();
        // On génère la vue
        $this->render('panier/del', compact('panier_data'));
    }

    public function delAll()
    {
        // On instancie le class correspondant à la table annonces
        $panier = new PanierModel;
        // On appelle la méthode search qui va rechercher les annonces pertinante dans la base de données
        $panier_data = $panier->delAll();
        // On génère la vue
        $this->render('panier/delAll', compact('panier_data'));
    }
}
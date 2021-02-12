<?php
namespace App\Controllers;

use App\Core\Form;
use App\Models\AnnonceModel;

class AnnonceController extends Controller
{
    /**
     * Cette méhode affichera une page listant toutes les annonces de la BDD
     *
     * @return void
     */
    public function index()
    {
        // On instancie le class correspondant à la table annonces
        $annonce = new AnnonceModel;
        // On appelle la méthode findAll qui va enregistrer les annonces dans $annonces
        $annonces = $annonce->findAll();
        
        // On génère la vue
        $this->render('annonce/index', compact('annonces'));
    }

    /**
     * Affiche 1 annonce
     *
     * @param [type] $id
     * @return void
     */
    public function voir(int $id)
    {
        $annonce = new AnnonceModel;
        $annonces = $annonce->find($id);
        
        $this->render('annonce/voir', compact('annonces'));
    }

    /**
     * Ajouter une annonce
     *
     * @return void
     */
    public function ajouter()
    {
        // On vérifie que  le formulaire est complet
        if (Form::validate($_POST, ['titre', 'description'])) {
            // Le forumlaire est complet
            // On se protège des failles xss
            $titre = strip_tags($_POST['titre']);
            $description = strip_tags($_POST['description']);
            
            // On instancie notre modele
            $annonce = new AnnonceModel;

            // On hydrate l'objet
            $annonce->setTitre($titre)
                ->setDescription($description)
        ;

            // On crée l'annonce en BDD
            $annonce->create();

            // On redirige 
            $_SESSION['success'] = "votre annonce à été enregistrée avec sucess";
            header('location: '.ACCUEIL.'boutique');
        }else {
            // Le formulaire est incomplet
            $_SESSION['erreur'] = "Le formulaire est incomplet";
            
        }

        if (isset($_SESSION['user']) AND !empty($_SESSION['user']['id'])) {
            // L'utilisateur est connecté
            $form = new Form;
            $form->debutForm()
                ->ajoutLabelFor('titre', 'titre de l\'annonce :')
                ->ajoutInput('text', 'titre', ['id' => 'titre', 'class' => 'form-control'])
                ->ajoutLabelFor('description', 'description de l\'annonce')
                ->ajoutTextarea('description', '', ['class' => 'form-control'])
                ->ajoutBouton('Ajouter', ['class' => 'btn btn-primary'])
                ->finForm()
            ;

            $this->render('annonce/ajouter', ['form' => $form->create()]);

        }else {
            // L'utilisateur n'est pas connecté
            $_SESSION['erreur'] = "Vous devez être connecté(e) pour accéder à cette page";
            header('location: '.ACCUEIL.'users/login');
            exit;
        }
    }
}
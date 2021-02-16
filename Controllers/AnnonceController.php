<?php
namespace App\Controllers;

use App\Core\Form;
use App\Models\AnnonceModel;
use App\Models\PhotoAnnonceModel;

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
    public function ajouterPro()
    {
        // On vérifie que  le formulaire est complet
        if (Form::validate($_POST, ['titre', 'description', 'prix', 'stock'])) {
            // Le forumlaire est complet
            // On se protège des failles xss
            $titre = strip_tags($_POST['titre']);
            $description = strip_tags($_POST['description']);
            $prix = (int) $_POST['prix'];
            $stock = (int) $_POST['stock'];

            // On instancie notre modele
            $annonce = new AnnonceModel;

            // On hydrate l'objet
            $annonce->setTitre($titre)
                ->setDescription($description)
                ->setPrix($prix)
                ->setStock($stock)
                ->setBoutique_pro_id($_SESSION['user']['id'])
            ;

            // On crée l'annonce en BDD
            $annonce->create();

            // On retour chercher l'annonce crée pour obtenir son id
            $annonce = $annonce->findAnnonceByPro($_SESSION['user']['id']);

            // On instancie la classe photo
            $photo = new PhotoAnnonceModel;

            //Taille max de la photo
            $tailleMax = 2000000;

            // Extensions valides pour la photo
            $extensionValides = ['jpg', 'jpeg', 'gif', 'png'];

            if($_FILES['avatar']['size'] <= $tailleMax){
                // La taille du fichier est bien inféreur à ce que l'on demande
                // On vérifie l'extension
                $extensionUpload = strtolower(substr(strrchr($_FILES['photo_principale']['name'], '.'),1));
                if (in_array($extensionUpload, $extensionValides)) {
                    // La taille et l'extension de la photo sont valides

                    // Chemin et nom du fichier que l'on va enregistrer 
                    $chemin = 'public/img/annonce/'.$annonce->id.'.'.$extensionUpload;

                    // On enregistre le fichier grace à move et $resultat = false ou true
                    $resultat = move_uploaded_file($_FILES['photo_principale']['tmp_name'], $chemin);
                    if ($resultat) {   
                        // On hydrate l'objet
                        $photo->setAnnonce_id($annonce->id)
                            ->setPhoto($annonce->id.'.'.$extensionUpload)
                        ;
                        // On crée insert la photo en BDD
                        $photo->create();
                    }else{
                        $_SESSION['erreur'] = "Erreur durant l'importation du fichier";
                        header('location: '.ACCUEIL.'annonce/ajouter');
                        exit;
                    }
                }else {
                    $_SESSION['erreur'] = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
                    header('location: '.ACCUEIL.'annonce/ajouter');
                    exit;
                }
            }else {
                $_SESSION['erreur'] = "Votre photo de profil ne doit pas dépasser 2 mo";
                header('location: '.ACCUEIL.'annonce/ajouter');
                exit;
            }

            // On redirige 
            $_SESSION['success'] = "votre annonce à été enregistrée avec sucess";
            header('location: '.ACCUEIL.'boutiqueAccueil/accueilPro');
        }else {
            // Le formulaire est incomplet
            /* $_SESSION['erreur'] = "Le formulaire est incomplet"; */
            
        }

        
            // L'utilisateur est connecté
            $form = new Form;
            $form->debutForm('post','#', ['enctype' => 'multipart/form-data'])
                ->ajoutLabelFor('titre', 'titre de l\'annonce :')
                ->ajoutInput('text', 'titre', ['id' => 'titre', 'required' => true, 'class' => 'form-control'])
                ->ajoutLabelFor('description', 'description de l\'article')
                ->ajoutTextarea('description', '', ['id' => 'description', 'required' => true, 'class' => 'form-control'])
                ->ajoutLabelFor('prix', 'prix de l\'article :')
                ->ajoutInput('number', 'prix', ['id' => 'prix', 'required' => true, 'class' => 'form-control'])
                ->ajoutLabelFor('stock', 'nombre d\'articles en stock')
                ->ajoutInput('number', 'stock', ['id' => 'stock', 'class' => 'form-control'])
                ->ajoutLabelFor('photo_principale', 'photo principale :')
                ->ajoutInput('file', 'photo_principale', ['id' => 'photo_principale', 'required' => true, 'class' => 'form-control'])
                ->ajoutBouton('Ajouter', ['class' => 'btn btn-primary'])
                ->finForm()
            ;

            $this->render('annonce/ajouter_pro', ['form' => $form->create()]);

        
    }
}
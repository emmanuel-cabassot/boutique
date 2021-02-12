<?php
namespace App\Controllers;

use App\Core\Form;

use App\Models\AdresseParticulierModel;
use App\Models\AdresseProModel;
use App\Models\BoutiqueParticulierModel;
use App\Models\BoutiqueProModel;
use App\Models\UserModel;

class BoutiqueController extends Controller
{
    /**
     * Création de la boutique pro en BDD
     *
     * @return void
     */
    public function registerpro()
    {
        
        // On vérifie si le formulaire est complet
        if(Form::validate($_POST, ['nom','email', 'adresse', 'code', 'ville'])){
            $nom = strip_tags($_POST['nom']);
            $email = strip_tags($_POST['email']);
            $adresse = strip_tags($_POST['adresse']);
            $code = (int) $_POST['code'];
            $ville = strip_tags($_POST['ville']);
            $siret = $_POST['siret'];

            // On instancie la class Boutiquepro, Boutiqueparticulier et user
            $boutiquepro = new BoutiqueproModel;
            $boutiquepar = new BoutiqueParticulierModel;
            $user = new UserModel;

            // On vérifie que le nom de boutique et l'email n'existe pas 
            $nom_exist = $boutiquepro->findBy(['nom' => $nom]);
            $nom_existe = $boutiquepar->findBy(['nom_boutique' => $nom]);

            if (empty($nom_exist) AND empty($nom_existe)) {
                $email_exist = $boutiquepro->findBy(['email' => $email]);
                $email_existe = $user->findBy(['email' => $email]);
                if (empty($email_exist) AND empty($email_existe)) {
                    // On hydrate l'objet
                    $boutiquepro->setNom($nom)
                    ->setEmail($email)
                    ->setSiret($siret)
                    ;

                    // On crée la boutique en BDD
                    $boutiquepro->create();

                    // On recupere la boutiquepro crée en Bdd pour recupérer l'id et l'intégré dans la table adresse
                    $exist = $boutiquepro->findOneByEmail($email);

                    // On instancie la classe Adressepro
                    $adress = new AdresseProModel;

                    // On hydrate l'objet Adressepro
                    $adress->setBoutique_id($exist->id)
                        ->setAdresse($adresse)
                        ->setCode($code)
                        ->setVille($ville)
                    ;

                    // On crée l'adresse en bdd avec la clef primaire id de la table Boutiquepro
                    $adress->create();

        
                }else {
                    $_SESSION['erreur'] = "Ce mail existe déjà";
                }
            }else {
                $_SESSION['erreur'] = "Ce nom de société existe déjà";
            }          
        }
           
        $form = new Form;

        $form->debutForm()
            ->ajoutLabelFor('nom', 'Nom de la société:')
            ->ajoutInput('text', 'nom', ['id' => 'nom', 'class' => 'form-control', 'required' => true])
            ->ajoutLabelFor('email', 'E-mail :')
            ->ajoutInput('email', 'email', ['id' => 'email', 'class' => 'form-control', 'required' => true])
            ->ajoutLabelFor('adresse', 'Adresse')
            ->ajoutInput('text', 'adresse', ['id' => 'adresse', 'class' => 'form-control', 'required' => true])
            ->ajoutLabelFor('code', 'Code postal')
            ->ajoutInput('number', 'code', ['id' => 'code', 'class' => 'form-control', 'required' => true])
            ->ajoutLabelFor('ville', 'Ville :')
            ->ajoutInput('text', 'ville', ['id' => 'ville', 'class' => 'form-control', 'required' => true])
            ->ajoutLabelFor('siret', 'Numéro Siret')
            ->ajoutInput('number', 'siret', ['id' => 'siret', 'class' => 'form-control'])
            ->ajoutBouton('Créer boutique', ['class' => 'btn btn-primary col-12'])
            ->finForm()
        ;

        $this->render('boutique/registerpro', ['boutiqueForm' => $form->create()]);        
    }

    /**
     *  Création de la boutique particulier en BDD
     *
     * @return void
     */
    public function registerpar()
    {        
        $adress = new AdresseParticulierModel;
        $exist_adresse = $adress->requete('SELECT * FROM adresse_particulier WHERE user_id = '.$_SESSION['user']['id'])->fetchAll();


        // On vérifie si le formulaire est complet
        if(Form::validate($_POST, ['nom_boutique', 'nom', 'prenom', 'email'])){
            $nom_boutique = strip_tags($_POST['nom_boutique']);
            $nom = strip_tags($_POST['nom']);
            $prenom = strip_tags($_POST['prenom']);
            $email = strip_tags($_POST['email']);
            
            
            // On instancie la class Boutique particulier et Boutique pro
            $boutique = new BoutiqueParticulierModel;
            $boutiquepro = new BoutiqueProModel;
            $user = new UserModel;

            $nom_exist = $boutiquepro->findBy(['nom' => $nom_boutique]);
            $nom_existe = $boutique->findBy(['nom_boutique' => $nom_boutique]);
            if ($_SESSION['user']['email'] != $email) {
                $email_exist = $boutiquepro->findBy(['email' => $email]);
                $email_existe = $user->findBy(['email' => $email]);
                if (!empty($email_exist) OR !empty($email_existe)) {
                    $_SESSION['erreur'] = "Cet email est déjà pris";
                    header('location: '.ACCUEIL.'boutique/registerpar');
                    exit;
                }
            }
            

            if (empty($nom_exist) AND empty($nom_existe)) {
                // On hydrate l'objet
                $boutique->setNom_boutique($nom_boutique)
                    ->setUser_id($_SESSION['user']['id'])              
                ;

                // On créer la boutique en BDD
                $boutique->create();   
                
                // On instancie la classe user pour mettre à jour la table user si modifications
                $user = new UserModel;
                $user->setId($_SESSION['user']['id'])
                    ->setNom($nom)
                    ->setPrenom($prenom)
                    ->setEmail($email) 
                    ->setDroit_id(10)   
                ;
               
                $user->update();

                if (empty($exist_adresse)) {
                    // Si on a pas d'adresse enregistrée dans BDD correspondant avec user_id
                    $adresse = strip_tags($_POST['adresse']);
                    $code = (int) $_POST['code'];
                    $ville = strip_tags($_POST['ville']);
    
                    // On hydrate l'objet
                    $adress->setUser_id($_SESSION['user']['id'])
                        ->setAdresse($adresse)
                        ->setCode($code)
                        ->setVille($ville)
                    ;
    
                    // On crée l'adresse en BDD
                    $adress->create();
                }
            }else {
                $_SESSION['erreur'] = "Ce nom de boutique existe déjà";
                header('location: '.ACCUEIL.'boutique/registerpar');
                exit;
            }
        }

            
        $form = new Form;

        // Création du formulaire avec la classe Form
        $form->debutForm()
            ->ajoutLabelFor('nom_boutique', 'Nom de votre boutique  :')
            ->ajoutInput('text', 'nom_boutique', ['id' => 'nom_boutique', 'class' => 'form-control', 'required' => true])
            ->ajoutLabelFor('nom', 'Nom  :')
            ->ajoutInput('text', 'nom', ['id' => 'nom', 'class' => 'form-control', 'value' => $_SESSION['user']['nom'] , 'required' => true])
            ->ajoutLabelFor('prenom', 'Prénom  :')
            ->ajoutInput('text', 'prenom', ['id' => 'prenom', 'class' => 'form-control', 'value' => $_SESSION['user']['prenom'] , 'required' => true])
            ->ajoutLabelFor('email', 'E-mail :')
            ->ajoutInput('email', 'email', ['id' => 'email', 'class' => 'form-control', 'value' => $_SESSION['user']['email'] , 'required' => true]);
            if (empty($exist_adresse)) {
            $form->ajoutLabelFor('adresse', 'Entrez votre adresse')
                ->ajoutInput('text', 'adresse', ['id' => 'adresse', 'class' => 'form-control', 'required' => true])
                ->ajoutLabelFor('code', 'Code postal')
                ->ajoutInput('number', 'code', ['id' => 'code', 'class' => 'form-control', 'required' => true])
                ->ajoutLabelFor('ville', 'Ville :')
                ->ajoutInput('text', 'ville', ['id' => 'ville', 'class' => 'form-control', 'required' => true]);
            }
            $form->ajoutBouton('Créer boutique', ['class' => 'btn btn-primary col-12'])
            ->finForm()
        ;

        $this->render('boutique/registerpar', ['boutiqueForm' => $form->create()]);       
    }
}
<?php
namespace App\Controllers;

use App\Core\Form;
use App\Models\BoutiqueProModel;
use App\Models\PhotoAvatarModel;
use App\Models\UserModel;

class UserController extends Controller
{
    /**
     * Connexion de l'utilisateur
     *
     * @return void
     */
    public function login()
    {
        // On vérifie si le formulaire est complet
        if(Form::validate($_POST, ['email', 'password'])){

            // On vérifie en BDD d'un utilisateur à un email qui correspond
            $user = new UserModel;
            $boutique = new BoutiqueProModel;
            $user_exist = $user->findOneByEmail(strip_tags($_POST['email']));
            $boutique_exist = $boutique->findOneByEmail($_POST['email']);
            

            if (!$user_exist AND !$boutique_exist) {
                $_SESSION['erreur'] = "L'adresse e-mail et/ou mot de passe est incorrect";
                header('location: '.ACCUEIL.'user/login');
                exit;
            }
             
            if (!empty($user_exist)) {
                // l'utilisateur existe et on hydrate l'user avec user_exist
                $user = $user->hydrate($user_exist);

                // On vérifie que le mot de passe est correct
                if(password_verify($_POST['password'], $user->getPassword())) {
                    // Le mot de passe est bon
                    $user->setSession();
                    $_SESSION['success'] = "Vous êtes connecté";
                    header('location: '.ACCUEIL.'main');
                    exit;
                }
                else {
                    $_SESSION['erreur'] = "L'adresse e-mail et/ou mot de passe est incorrect";
                    header('location: '.ACCUEIL.'user/login');
                    exit;
                }
            }

            if (!empty($boutique_exist)) {
                // La boutique existe et on hydrate boutique avec boutique_exist
                $boutique = $boutique->hydrate($boutique_exist);

                // On vérifie que le mot de passe est correct
                if(password_verify($_POST['password'], $boutique->getPassword())) {
                    // Le mot de passe est bon
                    $boutique->setSession();
                    $_SESSION['success'] = "Vous êtes connecté";
                    header('location: '.ACCUEIL.'main');
                    exit;
                }
                else {
                    $_SESSION['erreur'] = "L'adresse e-mail et/ou mot de passe est incorrect";
                    header('location: '.ACCUEIL.'user/login');
                    exit;
                }
            }
            

        }
        
        $form = new Form;

        $form->debutForm()
            ->ajoutLabelFor('email', 'E-mail:')
            ->ajoutInput('email', 'email', ['class' => 'form-control', 'id' => 'email', 'required' => true])
            ->ajoutLabelFor('pass', 'Mot de passe :')
            ->ajoutInput('password', 'password', ['class' => 'form-control', 'id' => 'pass'])         
            ->ajoutBouton('Me connecter', ['class' => 'btn btn-primary col-12'])
            ->finForm();
                
        $this->render('user/login', ['loginForm' => $form->create()]);       
    }   

    /**
     * Inscription des utilisateurs
     *
     * @return void
     */
    public function register()
    {  
        // On vérifie si le formulaire est valide
        if(Form::validate($_POST, ['nom', 'prenom', 'email', 'password'])){
            // Le formulaire est valide On nettoie et on encode le mot de passe
            $nom = strip_tags($_POST['nom']);
            $prenom = strip_tags($_POST['prenom']);
            $email = strip_tags($_POST['email']);
            $pass = password_hash($_POST['password'], PASSWORD_ARGON2I);
        
            // On instancie la classe Users et la classe boutiquepro
            $user = new UserModel;
            $boutiquepro = new BoutiqueProModel;
            $email_exist = $boutiquepro->findOneByEmail($email);
            $email_existe = $user->findOneByEmail($email);
            if (!empty($email_exist) OR !empty($email_existe)) {
                // l'email est déjà pris
                $_SESSION['erreur'] = "Cet email est déjà pris";
                header('location: '.ACCUEIL.'user/register');
                exit;
            }

            // On hydrate l'objet
            $user->setEmail($email)
                ->setPassword($pass)
                ->setNom($nom)
                ->setPrenom($prenom)
                ->setDroit_id(1)
            ; 

            //On stock l'utilisateur en BDD
            $user->create();
            
            $_SESSION['success'] = "Votre compte à été crée, connectez-vous";
            header('location: '.ACCUEIL.'user/login');
        }

        $form = new Form;
        
        // Formulaire fait grace à la classe Form
        $form->debutForm()
            ->ajoutLabelFor('nom', 'nom :')
            ->ajoutInput('text', 'nom', ['id' => 'nom', 'class' => 'form-control'])
            ->ajoutLabelFor('prenom', 'prénom :')
            ->ajoutInput('text', 'prenom', ['id' => 'prenom', 'class' => 'form-control'])
            ->ajoutLabelFor('email', 'E-mail :')
            ->ajoutInput('email', 'email', ['id' => 'email', 'class' => 'form-control'])
            ->ajoutLabelFor('password', 'Mot de passe :')
            ->ajoutInput('password', 'password', ['id' => 'password', 'class' => 'form-control'])
            ->ajoutBouton('M\'inscrire', ['class' => 'btn btn-primary'])
            ->finForm()
        ;

        $this->render('user/register', ['registerForm' => $form->create()]);
    }

    /**
     * Modifie le profil de l'utilisateur
     *
     * @return void
     */
    public function profil()
    {
        // Validation pour le profil
        if(Form::validate($_POST, ['nom', 'prenom', 'email', 'password'])){
            // Le formulaire est valide On nettoie et on encode le mot de passe
            $nom = strip_tags($_POST['nom']);
            $prenom = strip_tags($_POST['prenom']);
            $email = strip_tags($_POST['email']);
            $pass = password_hash($_POST['password'], PASSWORD_ARGON2I);
        
            if (isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']) ) {
                // Une photo à bien été mise dans le formulaire
                //Taille max
                $tailleMax = 4000000;
                // Ext"extensions valides
                $extensionValides = ['jpg', 'jpeg', 'gif', 'png'];

                if($_FILES['avatar']['size'] <= $tailleMax){
                    // La taille du fichier est bien inféreur à ce que l'on demande
                    // On vérifie l'extension
                    $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'),1));

                    if (in_array($extensionUpload, $extensionValides)) {
                        // La taille et l'extension de la photo sont valides
                        // On recherche en BDD si une photo existe
                        $photo = new PhotoAvatarModel;
                        $photos = $photo->findBy(['user_id' => $_SESSION['user']['id']]);
                        if (!empty($photos)) {
                            // Une photo de profil est déjà enregistrée
                            // On supprime la photo de profil enregistrée dans le fichier
                            $chemin_supp = 'public/img/avatar/'.$photos[0]->photo;
                            unlink($chemin_supp);
                            // On supprime la photo de profil enregistrée dans la bdd
                            $photo->deletePhotoUser($_SESSION['user']['id']);
                            //Chemin et nom du fichier que l'on va enregistrer 
                            $chemin = 'public/img/avatar/'.$_SESSION['user']['id'].'.'.$extensionUpload;
                            // On enregistre le fichier grace à move et $resultat = false ou true
                            $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                            if ($resultat) {   
                                // On hydrate l'objet
                                $photo->setUser_id($_SESSION['user']['id'])
                                    ->setPhoto($_SESSION['user']['id'].'.'.$extensionUpload)
                                ;
                                // On crée insert la photo en BDD
                                $photo->create();
                           
                            }else{
                                $_SESSION['erreur'] = "Erreur durant l'importation du fichier";
                                header('location: '.ACCUEIL.'user/profil');
                                exit;
                            }
                        }else {
                            // Pas de photo de profil enregistrée 
                            // Chemin et nom du fichier que l'on va enregistrer 
                            $chemin = 'public/img/avatar/'.$_SESSION['user']['id'].'.'.$extensionUpload;
                            // On enregistre le fichier grace à move et $resultat = false ou true
                            $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                            if ($resultat) {   
                                // On hydrate l'objet
                                $photo->setUser_id($_SESSION['user']['id'])
                                    ->setPhoto($_SESSION['user']['id'].'.'.$extensionUpload)
                                ;
                                // On crée insert la photo en BDD
                                $photo->create();
                            }else{
                                $_SESSION['erreur'] = "Erreur durant l'importation du fichier";
                                header('location: '.ACCUEIL.'user/profil');
                                exit;
                            }
                        }
                    }else{
                        $_SESSION['erreur'] = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
                        header('location: '.ACCUEIL.'user/profil');
                        exit;
                    }
                }else{
                    $_SESSION['erreur'] = "Votre photo de profil ne doit pas dépasser 4 mo";
                    header('location: '.ACCUEIL.'user/profil');
                    exit;
                }
            }
                        
                        
            
            
            // On instancie la classe Users
            $user = new UserModel;

            // On hydrate l'objet
            $user->setId((int) $_SESSION['user']['id'])
                ->setEmail($email)
                ->setPassword($pass)
                ->setNom($nom)
                ->setPrenom($prenom)
            ; 

            //On stock l'utilisateur en BDD avec ses modifications
            $user->update();

            // On met à jour les valeurs de la session
            $user->setSession();

            // On fait passer le message de success
            $_SESSION['success'] = "Votre profil à été modifié";
        }
        
        // Validation pour l'adresse
        if(Form::validate($_POST, ['adresse', 'code', 'ville', 'passwor'])){
            // Le formulaire est valide On nettoie et on encode le mot de passe
            $adresse = strip_tags($_POST['adresse']);
            (int) $code = ($_POST['code']);
            $ville = strip_tags($_POST['ville']);
            $pass = password_hash($_POST['passwor'], PASSWORD_ARGON2I);

            
        }


        $form = new Form;

        $form->debutForm('post','#', ['enctype' => 'multipart/form-data'])
            ->ajoutLabelFor('nom', 'Nom :')
            ->ajoutInput('text', 'nom', ['id' => 'nom', 'class' => 'form-control', 'value' => $_SESSION['user']['nom'] ])
            ->ajoutLabelFor('prenom', 'Prénom :')
            ->ajoutInput('text', 'prenom', ['id' => 'prenom', 'class' => 'form-control', 'value' => $_SESSION['user']['prenom']])
            ->ajoutLabelFor('email', 'E-mail :')
            ->ajoutInput('email', 'email', ['id' => 'email', 'class' => 'form-control', 'value' => $_SESSION['user']['email']])
            ->ajoutLabelFor('avatar', 'photo de profil :')
            ->ajoutInput('file', 'avatar', ['id' => 'avatar', 'class' => 'form-control'])
            ->ajoutLabelFor('password', 'Mot de passe :')
            ->ajoutInput('pass', 'password', ['id' => 'pass', 'class' => 'form-control'])
            ->ajoutBouton('Modifier mon profil', ['class' => 'btn btn-primary'])
            ->finForm()
        ;

        $adress = new Form;

        $adress->debutForm()
            ->ajoutLabelFor('adresse', 'Adresse :')
            ->ajoutInput('text', 'adresse', ['id' => 'adresse', 'class' => 'form-control'])
            ->ajoutLabelFor('code', 'Code postal :')
            ->ajoutInput('numer', 'code', ['id' => 'code', 'class' => 'form-control'])
            ->ajoutLabelFor('ville', 'Ville :')
            ->ajoutInput('text', 'ville', ['id' => 'ville', 'class' => 'form-control'])
            ->ajoutLabelFor('passwor', 'Mot de passe :')
            ->ajoutInput('pass', 'passwor', ['id' => 'pass', 'class' => 'form-control'])
            ->ajoutBouton('Valider adresse', ['class' => 'btn btn-primary'])
            ->finForm()
        ;
            



        $this->render('user/profil', ['profilForm' => $form->create(), 'adressForm' => $adress->create()]);
    }

    /**
     * Déconnexion de l'utilisateur
     *
     * @return void
     */
    public function logout()
    {
        unset($_SESSION['user']);
        header('location: '.ACCUEIL);
        exit;
    }

        
}
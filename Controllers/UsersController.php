<?php
namespace App\Controllers;

use App\Core\Form;
use App\Models\UsersModel;

class UsersController extends Controller
{
    public function login()
    {
        // On vérifie si le formulaire est complet
        if(Form::validate($_POST, ['email', 'password'])){

            // On vérifie en BDD d'un utilisateur à un email qui correspond
            $user = new UsersModel;
            $userArray = $user->findOneByEmail(strip_tags($_POST['email']));
            

            if (!$userArray) {
                $_SESSION['erreur'] = "L'adresse e-mail et/ou mot de passe est incorrect";
                header('location: \projectpool2\boutique/users/login');
                exit;
            }

            // l'utilisateur existe et on hydrate l'userArray
            $user = $user->hydrate($userArray);

            // On vérifie que le mot de passe est correct
            if(password_verify($_POST['password'], $user->getPassword())) {
                // Le mot de passe est bon
                $user->setSession();
                $_SESSION['success'] = "Vous êtes connecté";
                header('location: \projectpool2\boutique/annonces');
                exit;
            }
            else {
                $_SESSION['erreur'] = "L'adresse e-mail et/ou mot de passe est incorrect";
                header('location: \projectpool2\boutique/users/login');
                exit;
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
                
        $this->render('users/login', ['loginForm' => $form->create()]);       
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
        
            // On instancie la classe Users
            $user = new UsersModel;

            // On hydrate l'objet
            $user->setEmail($email)
                ->setPassword($pass)
                ->setNom($nom)
                ->setPrenom($prenom)
            ; 

            //On stock l'utilisateur en BDD
            $user->create();
        }

        $form = new Form;
        
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

        $this->render('users/register', ['registerForm' => $form->create()]);
    }

    public function profil()
    {
        if(Form::validate($_POST, ['nom', 'prenom', 'email', 'password'])){
            // Le formulaire est valide On nettoie et on encode le mot de passe
            $nom = strip_tags($_POST['nom']);
            $prenom = strip_tags($_POST['prenom']);
            $email = strip_tags($_POST['email']);
            $pass = password_hash($_POST['password'], PASSWORD_ARGON2I);
        
            // On instancie la classe Users
            $user = new UsersModel;

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

        $form = new Form;

        $form->debutForm()
            ->ajoutLabelFor('nom', 'Nom :')
            ->ajoutInput('text', 'nom', ['id' => 'nom', 'class' => 'form-control', 'value' => $_SESSION['user']['nom'] ])
            ->ajoutLabelFor('prenom', 'Prénom :')
            ->ajoutInput('text', 'prenom', ['id' => 'prenom', 'class' => 'form-control', 'value' => $_SESSION['user']['prenom']])
            ->ajoutLabelFor('email', 'E-mail :')
            ->ajoutInput('email', 'email', ['id' => 'email', 'class' => 'form-control', 'value' => $_SESSION['user']['email']])
            ->ajoutLabelFor('password', 'Mot de passe :')
            ->ajoutInput('pass', 'password', ['id' => 'pass', 'class' => 'form-control'])
            ->ajoutBouton('Modifier mon profil', ['class' => 'btn btn-primary'])
            ->finForm()
        ;


        $this->render('users/profil', ['profilForm' => $form->create()]);
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header('location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }

        
}
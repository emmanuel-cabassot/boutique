<?php
namespace App\Controllers;

use App\Core\Form;
use App\Models\BoutiquesModel;

class BoutiquesController extends Controller
{
    public function register()
    {
        if (isset($_SESSION['user']['id']) AND !empty($_SESSION['user']['id'])) {

            // On vérifie si le formulaire est complet
        if(Form::validate($_POST, ['nom', 'prenom','email', 'adresse', 'code', 'ville'])){
            $nom = strip_tags($_POST['nom']);
            $prenom = strip_tags($_POST['prenom']);
            $email = strip_tags($_POST['email']);
            $adresse = strip_tags($_POST['adresse']);
            $code = (int) $_POST['code'];
            $ville = strip_tags($_POST['ville']);
            if (isset($_POST['siret'])) {
                $siret = $_POST['siret'];

                $boutique = new BoutiquesModel;
                $boutique->setNom($nom)
                    ->setPrenom($prenom)
                    ->setEmail($email)
                    ->setAdresse($adresse)
                    ->setCode($code)
                    ->setVille($ville)
                    ->setSiret($siret)
                    ->setUser_id($_SESSION['user']['id'])
                ;

                $boutique->create();
            }else {
                $boutique = new BoutiquesModel;
                $boutique->setNom($nom)
                    ->setPrenom($prenom)
                    ->setEmail($email)
                    ->setAdresse($adresse)
                    ->setCode($code)
                    ->setVille($ville)
                    ->setUser_id($_SESSION['user']['id'])
                ;
                $boutique->create();
            }
        }

            
        $form = new Form;

        $form->debutForm()
            ->ajoutLabelFor('nom', 'Nom :')
            ->ajoutInput('text', 'nom', ['id' => 'nom', 'class' => 'form-control', 'value' => $_SESSION['user']['nom'], 'required' => true])
            ->ajoutLabelFor('prenom', 'Prénom :')
            ->ajoutInput('text', 'prenom', ['id' => 'prenom', 'class' => 'form-control', 'value' => $_SESSION['user']['prenom'], 'required' => true])
            ->ajoutLabelFor('email', 'E-mail :')
            ->ajoutInput('email', 'email', ['id' => 'email', 'class' => 'form-control', 'value' => $_SESSION['user']['email'], 'required' => true])
            ->ajoutLabelFor('adresse', 'Entrez votre adresse')
            ->ajoutInput('text', 'adresse', ['id' => 'adresse', 'class' => 'form-control', 'required' => true])
            ->ajoutLabelFor('code', 'Code postal')
            ->ajoutInput('number', 'code', ['id' => 'code', 'class' => 'form-control', 'required' => true])
            ->ajoutLabelFor('ville', 'Ville :')
            ->ajoutInput('text', 'ville', ['id' => 'ville', 'class' => 'form-control', 'required' => true])
            ->ajoutLabelFor('siret', 'Entreprise? Entrez votre numéro Siret')
            ->ajoutInput('number', 'siret', ['id' => 'siret', 'class' => 'form-control'])
            ->ajoutBouton('Créer boutique', ['class' => 'btn btn-primary col-12'])
            ->finForm()
        ;

        $this->render('boutiques/register', ['boutiqueForm' => $form->create()]);
        }
        else {
            $_SESSION['erreur'] = "Vous n'avez pas les accès pour cette page";
            header('location:  \projectpool2\boutique/main');
        }
    }
}
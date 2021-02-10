<?php
namespace App\Controllers;

use App\Core\Form;
use App\Models\BoutiquesModel;

class BoutiquesController extends Controller
{
    public function register()
    {
        
            // On vérifie si le formulaire est complet
        if(Form::validate($_POST, ['nom','email', 'adresse', 'code', 'ville'])){
            $nom = strip_tags($_POST['nom']);
            $email = strip_tags($_POST['email']);
            $adresse = strip_tags($_POST['adresse']);
            $code = (int) $_POST['code'];
            $ville = strip_tags($_POST['ville']);
            $siret = $_POST['siret'];

            // On instancie la class Boutique
            $boutique = new BoutiquesModel;

            // On hydrate l'objet
            $boutique->setNom($nom)
                ->setEmail($email)
                ->setAdresse($adresse)
                ->setCode($code)
                ->setVille($ville)
                ->setSiret($siret)
            ;

            // On créer la boutique en BDD
            $boutique->create();
            
        }

            
        $form = new Form;

        $form->debutForm()
            ->ajoutLabelFor('nom', 'Nom :')
            ->ajoutInput('text', 'nom', ['id' => 'nom', 'class' => 'form-control', 'required' => true])
            ->ajoutLabelFor('email', 'E-mail :')
            ->ajoutInput('email', 'email', ['id' => 'email', 'class' => 'form-control', 'required' => true])
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
}
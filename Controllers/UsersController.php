<?php
namespace App\Controllers;

use App\Core\Form;

class UsersController extends Controller
{
    public function login()
    {
        $form = new Form;

        $form->debutForm()
            ->ajoutLabelFor('email', 'E-mail:')
            ->ajoutInput('email', 'email', ['class' => 'form-control', 'id' => 'email', 'required' => true])
            ->ajoutLabelFor('pass', 'Mot de passe :')
            ->ajoutInput('password', 'password', ['class' => 'form-control', 'id' => 'pass'])         
            ->ajoutBouton('Me connecter', ['class' => 'btn btn-primary col-12'])
            ->finForm();

        
        $tt = 10;

                
        $this->render('users/login', ['loginForm' => $form->create(), 'tt' => $tt]);


       
            
    }   

        
}
<?php

namespace App\Controllers;

use App\Models\UserModel;

class MainController extends Controller
{
    public function index()
    {
        $utilisateurs = new UserModel;
        $utilisateurs = $utilisateurs->findAll();

        $this->render('main/index', compact('utilisateurs'));
    }
}
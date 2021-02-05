<?php

namespace App\Controllers;

use App\Models\UsersModel;

class MainController extends Controller
{
    public function index()
    {
        $utilisateurs = new UsersModel;
        $utilisateurs = $utilisateurs->findAll();

        $this->render('main/index', compact('utilisateurs'));
    }
}
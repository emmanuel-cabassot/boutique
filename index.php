<?php
use App\Autoloader;
use App\Core\Main;

// On définit une constante contenant le dossier racine du projet
define('ROOT', __DIR__);

// On importe l'autoloader
require_once ROOT.'/Autoloader.php';
Autoloader::register();

// On instancie Main (notre routeur)
$app = new Main();

// On démarre l'application
$app->start();
<?php
use App\Autoloader;
use App\Core\Main;

// On définit une constante contenant le dossier racine du projet
define('ROOT', __DIR__);

// On transforme php_self en chemin pour arriver à l'accueil grace aux liens
$accueil = $_SERVER['PHP_SELF'];
$accueil = str_replace('index.php', '', $accueil);
$accueil = str_replace('/', '\\', $accueil);
// On la definie dans une constante ACCUEIL
define('ACCUEIL', $accueil);

// On importe l'autoloader
require_once ROOT.'/Autoloader.php';
Autoloader::register();

// On instancie Main (notre routeur)
$app = new Main();

// On démarre l'application
$app->start();
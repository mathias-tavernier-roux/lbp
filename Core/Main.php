<?php
namespace App\core;

use App\Controllers\MainController;

/**
 * Ceci est notre Routeur
 */
class Main
{
    public function start()
    {
        // On démarre la session
        session_start();
        
        // http:/boutique/controleur/methode/parametres
        //http:/boutique/annonces/detail/brouette
        //http:/boutique/index.php?p=annonces/detail/brouette
        // On retire le trailing slash eventuel de l'URL
        // On recupere l'URL
        $uri = $_SERVER['QUERY_STRING'];

        //var_dump($_SERVER['DOCUMENT_ROOT']);die;
        //$uri = str_replace('/projectpool2/boutique', '', $uri); 
        // On vérifie que $uri n'est pas vide et se termine par un slash
        if (!empty($uri) AND $uri[-1] === "/" AND $uri != "/") {
            $uri = substr($uri, 0, -1);

            // On envoie un code de redirection permanente
            http_response_code(301);

            // On redirige vers l'url sans le slash
            header('location: '.$uri);
        }
        
        // On gère les paramètres d'URL
        //p=controleur/methode/paramètre
        // On sépare les paramètres dans un tableau
        $params = explode('/', $_GET['p']);

        if ($params[0] != '') {
            // On a au moins un paramètre
            // On recupere le nom du controleur à instancier avec son namspace
            $controleur = '\\App\\Controllers\\'.ucfirst(array_shift($params)).'Controller';
            // On instancie le controleur
            
            $controleur = new $controleur();
            
            // On recupere le deuxieme parametre d'URL
            $action = (isset($params[0])) ? array_shift($params) : 'index';

            if (method_exists($controleur, $action)) {
                // Si il reste des paramètres on les passe à la méthode
                (isset($params[0])) ? call_user_func_array([$controleur, $action], $params) :
                $controleur->$action();
            }else {
                http_response_code(404);
                echo "la page recherchée n'existe pas";
            }            

        }else{
            // Si on a pas de paramètres on instancie le controleur par défaut
            $controleur = new MainController();
            $controleur->index();
        }
        
   }
}
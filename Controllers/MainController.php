<?php

namespace App\Controllers;

use App\Models\AnnonceModel;
use App\Models\CategorieModel;
use App\Models\PhotoAnnonceModel;

class MainController extends Controller
{
    

    /**
     * Cette méhode affichera une page listant toutes les annonces de la BDD
     *
     * @return void
     */
    public function index()
    {
        // On instancie le class correspondant à la table annonces
        $annonce = new AnnonceModel;
        // On appelle la méthode findAll qui va enregistrer les annonces dans $annonces
        $annonces = $annonce->findAllAnnoncesByDesc();

        $categories_list = new CategorieModel;
        $categories_list = $categories_list->findCategories();

        // On génère la vue
        $this->render('main/index', ['annonces' => $annonces, 'categories_list' => $categories_list]);
    }
}
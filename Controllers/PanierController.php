<?php
namespace App\Controllers;
use App\Models\PanierModel;
class PanierController extends Controller
{
public function view()
    {
        // On instancie le class correspondant à la table annonces
        $panier = new PanierModel;
        // On appelle la méthode search qui va rechercher les annonces pertinante dans la base de données
        $panier_data = $panier->view();
        // On génère la vue
        $this->render('panier/panier', compact('panier_data'));
    }

public function add()
    {
        // On instancie le class correspondant à la table annonces
        $panier = new PanierModel;
        // On appelle la méthode search qui va rechercher les annonces pertinante dans la base de données
        $panier_data = $panier->add();
        if ($panier_data == "ERROR1")
        // On génère la vue
        $this->render('panier/error1', compact('panier_data'));
        if ($panier_data == "SUCCESS")
        // On génère la vue
        $this->render('panier/add', compact('panier_data'));
    }

    public function edit()
    {
        // On instancie le class correspondant à la table annonces
        $panier = new PanierModel;
        // On appelle la méthode search qui va rechercher les annonces pertinante dans la base de données
        $panier_data = $panier->edit();
        if ($panier_data == "Update")
        {
        // On génère la vue
        $this->render('panier/edit', compact('panier_data'));
        }
        if ($panier_data == "ERROR1")
        {
        // On génère la vue Delete vu que l'article a été supprimé
        $this->render('panier/error1', compact('panier_data'));  
        }
        if ($panier_data == "Delete")
        {
        // On génère la vue Delete vu que l'article a été supprimé
        $this->render('panier/del', compact('panier_data'));  
        }
        $this->render('panier/debug', compact('panier_data'));
    }

    public function del()
    {
        // On instancie le class correspondant à la table annonces
        $panier = new PanierModel;
        // On appelle la méthode search qui va rechercher les annonces pertinante dans la base de données
        $panier_data = $panier->del();
        // On génère la vue
        $this->render('panier/del', compact('panier_data'));
    }

    public function delAll()
    {
        // On instancie le class correspondant à la table annonces
        $panier = new PanierModel;
        // On appelle la méthode search qui va rechercher les annonces pertinante dans la base de données
        $panier_data = $panier->delAll();
        // On génère la vue
        $this->render('panier/delAll', compact('panier_data'));
    }
}
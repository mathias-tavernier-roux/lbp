<?php
namespace App\Controllers;
use App\Models\CommandeModel;
class CommandeController extends Controller
{
    public function index()
    {
        // On instancie le class correspondant à la table annonces
        $commande = new CommandeModel;
        // On appelle la méthode search qui va rechercher les annonces pertinante dans la base de données
        $commande_data = $commande->view();
        $this->render('commande/index' ,compact('commande_data'));
    }
}
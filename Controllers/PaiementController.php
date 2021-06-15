<?php
namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\AdresseParticulierModel;
use App\Models\PanierModel;
use App\Models\CommandeModel;
use App\Models\UserModel;
use DateTime;

class PaiementController extends Controller
{
    public function index()
    {     
        $user = new UserModel;
        $user = $user->find($_SESSION['user']['id']);
        $adresse = new AdresseParticulierModel;
        $adresse = $adresse->findAdresse($_SESSION['user']['id']);
        // On instancie le class correspondant à la table annonces
        $panier = new PanierModel;
        // On appelle la méthode search qui va rechercher les annonces pertinante dans la base de données
        $panier_data = $panier->view();
        

        $this->render('paiement/index', ['panier_data' => $panier_data, 'user' => $user, 'adresse' => $adresse]);
    }
    public function success()
    {
        $panier = new PanierModel;
        $commande = New CommandeModel;
        $user = $_SESSION['user']['id'];
        $panier_buy = $panier->requeteS("SELECT `id`,`annonce_name`,`annonce_id`,`vendor_name`,`quantite`,`prix`, `livraison` FROM `panier` WHERE `user_id` = $user ORDER BY annonce_id DESC");
        $result = mysqli_fetch_assoc($panier_buy);
        foreach ($panier_buy as $panier) 
        {
            $prix = $result['prix'];
            $quantite = $result['quantite'];
            $livraison = $result['livraison'];
            $article_id = $result['annonce_id'];
            $article_name = $result['annonce_name'];
            $commande->add($prix,$livraison,$article_id,$article_name,$quantite,$user);
        }
        $commande->delpan($user);
        $this->render('paiement/success');
    }

}
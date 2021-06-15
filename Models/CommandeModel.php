<?php

namespace App\Models;

class CommandeModel extends Model
{
    protected $id;
    protected $annonce_id;
    protected $user_id;
    protected $vendor_id;
    protected $quantite;
    protected $prix_unité;
    protected $prix;

    public function __construct()
    {
        $this->table = 'commande';
    }

    public function add($commande, $livraison, $article_id, $article_name, $quantite, $user)
    {
        $commande = $commande;
        $quantite = $quantite;
        $livraison = $livraison;
        $article_id = $article_id;
        $article_name = $article_name;
        $user = $user;
        $date = date('dmY');
        $suivi = "$user$article_id$date";
        $requete = "INSERT INTO `commande`(`prix_commande`, `prix_livraison`, `user_id`,`annonce_name`, `annonce_id`, `quantite`, `suivi`) VALUES ($commande,$livraison,$user,'$article_name',$article_id,$quantite,$suivi)";
        $dbs = mysqli_connect("localhost", "root", "", "boutique");
        $query = mysqli_query($dbs, $requete);
        $requete = "SELECT `stock` FROM `annonce` WHERE `id` = $article_id";
        $dbs = mysqli_connect("localhost", "root", "", "boutique");
        $query = mysqli_query($dbs, $requete);
        $stock = mysqli_fetch_assoc($query);
        $nstock = $stock['stock'] - $quantite;
        if ($nstock <= 0) {
            $request = "DELETE FROM `annonce` WHERE `id` = $article_id";
            $this->requeteS($request);
        } else {
            $request = "UPDATE `annonce` SET `stock`=$nstock WHERE `id` = $article_id";
            $this->requeteS($request);
        }
    }
    public function delpan($user)
    {
        $user = $user;
        $request = "DELETE FROM `panier` WHERE `user_id` = $user";
        $this->requeteS($request);
    }
    public function view()
    {
        $user = $_SESSION['user']['id'];
        return $this->requete("SELECT * FROM `commande` WHERE `user_id` = $user");
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of prix_commande
     */
    public function getPrix_commande()
    {
        return $this->prix_commande;
    }

    /**
     * Set the value of prix_commande
     *
     * @return  self
     */
    public function setPrix_commande($prix_commande)
    {
        $this->prix_commande = $prix_commande;

        return $this;
    }

    /**
     * Get the value of prix_livraison
     */
    public function getPrix_livraison()
    {
        return $this->prix_livraison;
    }

    /**
     * Set the value of prix_livraison
     *
     * @return  self
     */
    public function setPrix_livraison($prix_livraison)
    {
        $this->prix_livraison = $prix_livraison;

        return $this;
    }

    /**
     * Get the value of user_id
     */
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of boutique_particulier_id
     */
    public function getBoutique_particulier_id()
    {
        return $this->boutique_particulier_id;
    }

    /**
     * Set the value of boutique_particulier_id
     *
     * @return  self
     */
    public function setBoutique_particulier_id($boutique_particulier_id)
    {
        $this->boutique_particulier_id = $boutique_particulier_id;

        return $this;
    }

    /**
     * Get the value of boutique_pro_id
     */
    public function getBoutique_pro_id()
    {
        return $this->boutique_pro_id;
    }

    /**
     * Set the value of boutique_pro_id
     *
     * @return  self
     */
    public function setBoutique_pro_id($boutique_pro_id)
    {
        $this->boutique_pro_id = $boutique_pro_id;

        return $this;
    }
}

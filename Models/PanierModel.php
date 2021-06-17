<?php

namespace App\Models;

class PanierModel extends Model
{
    protected $id;
    protected $annonce_id;
    protected $user_id;
    protected $vendor_id;
    protected $quantite;
    protected $prix_unité;
    protected $prix;
    protected $date;

    public function __construct()
    {
        $this->table = 'panier';
    }

    public function view()
    {

        $USER = $_SESSION['user']['id'];
        return $this->requete("SELECT `id`,`annonce_name`,`annonce_id`,`vendor_name`,`quantite`,`prix`, `livraison` FROM `panier` WHERE `user_id` = $USER ORDER BY annonce_id DESC")->fetchAll();
    }

    public function add()
    {
        $ARTNom = $_SESSION['Nom'];
        $ARTId = $_SESSION['IDA'];
        $ARTAcheteur = $_SESSION['user']['id'];
        $ARTVendeur = $_SESSION['Vendeur'];
        $ARTQuantité = $_POST['Quantité'];
        $ARTLivraison = $_SESSION['Livraison'];
        // Verification du panier actuel pour eviter les doublons
        $request = "SELECT `quantite` FROM `panier` WHERE `annonce_id` = $ARTId";
        $query = $this->requeteS($request);
        $result = mysqli_fetch_assoc($query);
        if ($result == null) {
            $request = "INSERT INTO panier (`user_id`, `annonce_id`, `annonce_name`, `vendor_name`, `quantite`,`livraison`) VALUES ($ARTAcheteur, $ARTId, '$ARTNom','$ARTVendeur',$ARTQuantité,$ARTLivraison)";
            $this->requeteS($request);
            return "SUCCESS";
        } else {
            $nquentite = $ARTQuantité + $result['quantite'];
            $request = "SELECT `stock` FROM `annonce` WHERE `id` = $ARTId";
            $query = $this->requeteS($request);
            $result = mysqli_fetch_assoc($query);
            if ($result['stock'] < $nquentite) {
                return "ERROR1";
            } else {
                $request = "UPDATE `panier` SET `quantite`= $nquentite, `livraison`= $ARTLivraison WHERE `annonce_id` = $ARTId && `user_id` = $ARTAcheteur";
                $this->requeteS($request);
                return "SUCCESS";
            }
        }
    }

    public function del()
    {
        $TARGET = $_POST['Produit'];
        $USER_TARGET = $_SESSION['user']['id'];
        $request = "DELETE FROM `panier` WHERE `annonce_id` = $TARGET && `user_id` = $USER_TARGET";
        $this->requeteS($request);
        return $request;
    }

    public function edit()
    {
        $TARGET = $_POST['Produit'];
        $USER_TARGET = $_SESSION['user']['id'];
        $request = "SELECT `quantite` FROM `panier` WHERE `annonce_id` = $TARGET";
        $query = $this->requeteS($request);
        $result = mysqli_fetch_assoc($query);
        if ($_POST['EDIT'] == "+") 
        {
            $nquentite = $result['quantite'] + 1;
            $request = "SELECT `stock` FROM `annonce` WHERE `id` = $TARGET";
            $query = $this->requeteS($request);
            $result = mysqli_fetch_assoc($query);
            if ($result['stock'] < $nquentite) 
            {
                return "ERROR1";
            } 
            else 
            {
                $request = "UPDATE `panier` SET `quantite`= $nquentite WHERE `annonce_id` = $TARGET && `user_id` = $USER_TARGET";
                $this->requeteS($request);
                return "Update";
            }
        }
        if ($_POST['EDIT'] == "-") 
            {
            $nquentite = $result['quantite'] - 1;
            if ($nquentite == 0) 
            {
                $request = "DELETE FROM `panier` WHERE `annonce_id` = $TARGET && `user_id` = $USER_TARGET";
                $this->requeteS($request);
                return "Delete";
            } 
            else 
            {
                $request = "UPDATE `panier` SET `quantite`= $nquentite WHERE `annonce_id` = $TARGET && `user_id` = $USER_TARGET";
                $this->requeteS($request);
                return "Update";
            }
        }
    }

    public function delAll()
    {
        $USER_TARGET = $_SESSION['user']['id'];
        $request = "DELETE FROM `panier` WHERE `user_id` = $USER_TARGET";
        $this->requeteS($request);
        return $request;
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
     * Get the value of annonce_id
     */
    public function getAnnonce_id()
    {
        return $this->annonce_id;
    }

    /**
     * Set the value of annonce_id
     *
     * @return  self
     */
    public function setAnnonce_id($annonce_id)
    {
        $this->annonce_id = $annonce_id;

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
     * Get the value of quantite
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set the value of quantite
     *
     * @return  self
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }
}

<?php
namespace App\Models;

class BoutiqueParticulierModel extends Model
{
    protected $id;
    protected $nom_boutique;
    protected $create_at;
    protected $droit_id = 10;
    protected $user_id;

    public function __construct()
    {
        $this->table = 'boutique_particulier';
    }

    /**
     * Undocumented function
     *
     * @param [type] $user_id
     * @return
     */
    public function findBoutiqueByUser($user_id)
    {
        return $this->requete("SELECT * FROM $this->table WHERE user_id = $user_id")->fetch();
    }

    /**
     * Cherche une boutique de particulier par rapport à l'id de la boutique
     *
     * @param int $id
     * @return
     */
    public function findBoutiqueById($id)
    {
        return $this->requete("SELECT * FROM $this->table WHERE id = ?", [$id])->fetch();
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
     * Get the value of nom_boutique
     */ 
    public function getNom_boutique()
    {
        return $this->nom_boutique;
    }

    /**
     * Set the value of nom_boutique
     *
     * @return  self
     */ 
    public function setNom_boutique($nom_boutique)
    {
        $this->nom_boutique = $nom_boutique;

        return $this;
    }

    /**
     * Get the value of create_at
     */ 
    public function getCreate_at()
    {
        return $this->create_at;
    }

    /**
     * Set the value of create_at
     *
     * @return  self
     */ 
    public function setCreate_at($create_at)
    {
        $this->create_at = $create_at;

        return $this;
    }

    /**
     * Get the value of droit_id
     */ 
    public function getDroit_id()
    {
        return $this->droit_id;
    }

    /**
     * Set the value of droit_id
     *
     * @return  self
     */ 
    public function setDroit_id($droit_id)
    {
        $this->droit_id = $droit_id;

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
}


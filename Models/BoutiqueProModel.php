<?php
namespace App\Models;

class BoutiqueProModel extends Model
{
    protected $id;
    protected $nom;
    protected $email;
    protected $password;
    protected $droit_id = 20;
    protected $create_at;
    protected $adresse_id = null;
    protected $siret;
    protected $rib = null;

    public function __construct()
    {
        $this->table = 'boutique_pro';
    }

    public function findbyId($boutique_pro_id)
    {
        return $this->requete("SELECT * FROM $this->table WHERE id = $boutique_pro_id")->fetch();
    }

    public function countByNom($nom)
    {
        return $this->requete("SELECT * FROM $this->table WHERE 'nom' = $nom")->fetch();
    }

    /** 
     * Crée la session de la boutique
     * @return void 
     */
    public function setSession()
    {
        $_SESSION['user'] = [
            'id' => $this->id,
            'nom' => $this->nom,
            'email' => $this->email,
            'droit' => $this->droit_id,            
        ];
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
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

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
     * Get the value of adresse_id
     */ 
    public function getAdresse_id()
    {
        return $this->adresse_id;
    }

    /**
     * Set the value of adresse_id
     *
     * @return  self
     */ 
    public function setAdresse_id($adresse_id)
    {
        $this->adresse_id = $adresse_id;

        return $this;
    }

    /**
     * Get the value of siret
     */ 
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set the value of siret
     *
     * @return  self
     */ 
    public function setSiret($siret)
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * Get the value of rib
     */ 
    public function getRib()
    {
        return $this->rib;
    }

    /**
     * Set the value of rib
     *
     * @return  self
     */ 
    public function setRib($rib)
    {
        $this->rib = $rib;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}
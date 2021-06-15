<?php
namespace App\Models;

class AdresseProModel extends Model
{
    protected $id;
    protected $adresse;
    protected $code;
    protected $ville;
    protected $boutique_id;

    public function __construct()
    {
        $this->table = 'adresse_pro';
    }

    public function findAdresse($boutique_id)
    {
        return $this->requete("SELECT * FROM $this->table WHERE boutique_id = $boutique_id")->fetch();
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
     * Get the value of adresse
     */ 
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set the value of adresse
     *
     * @return  self
     */ 
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get the value of code
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */ 
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of ville
     */ 
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set the value of ville
     *
     * @return  self
     */ 
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get the value of boutique_id
     */ 
    public function getBoutique_id()
    {
        return $this->boutique_id;
    }

    /**
     * Set the value of boutique_id
     *
     * @return  self
     */ 
    public function setBoutique_id($boutique_id)
    {
        $this->boutique_id = $boutique_id;

        return $this;
    }
}
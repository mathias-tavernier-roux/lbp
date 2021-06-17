<?php
namespace App\Models;

class AnnonceModel extends Model
{   
    protected $id;
    protected $titre;
    protected $categorie_id;
    protected $description;
    protected $prix;
    protected $poids;
    protected $stock;
    protected $created_at;
    protected $user_id;
    protected $boutique_pro_id;
    protected $boutique_particulier_id;

    public function __construct()
    {
        $this->table = 'annonce';
    }

    public function findAnnoneProLimit($boutique_pro_id)
    {
        return $this->requete("SELECT * FROM $this->table WHERE boutique_pro_id = $boutique_pro_id ORDER BY create_at DESC LIMIT 10")->fetchAll();
    }

    public function findAnnonceByPro($boutique_pro_id)
    {
        return $this->requete("SELECT * FROM $this->table WHERE boutique_pro_id = $boutique_pro_id ORDER BY create_at DESC")->fetch();
    }

    public function findAnnonceByPar($boutique_particulier_id)
    {
        return $this->requete("SELECT * FROM $this->table WHERE boutique_particulier_id = $boutique_particulier_id ORDER BY create_at DESC")->fetch();
    }

    public function search($titre,$categorie)
    {
        if ($categorie == "0")
        {
        return $this->requete("SELECT * FROM $this->table WHERE titre LIKE '%$titre%' ORDER BY create_at DESC")->fetchAll();
        }
        else
        {
        return $this->requete("SELECT * FROM annonce WHERE titre LIKE '%$titre%' && categorie_id LIKE $categorie ORDER BY create_at DESC")->fetchAll();
        }
    }

    public function findAnnonceParLimit($boutique_particulier_id)
    {
        return $this->requete("SELECT * FROM $this->table WHERE boutique_particulier_id = $boutique_particulier_id ORDER BY create_at DESC LIMIT 10")->fetchAll();
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
     * Get the value of titre
     */ 
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    
    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

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
     * Get the value of prix
     */ 
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set the value of prix
     *
     * @return  self
     */ 
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get the value of stock
     */ 
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @return  self
     */ 
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get the value of poids
     */ 
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * Set the value of poids
     *
     * @return  self
     */ 
    public function setPoids($poids)
    {
        $this->poids = $poids;

        return $this;
    }

    /**
     * Get the value of categorie_id
     */ 
    public function getCategorie_id()
    {
        return $this->categorie_id;
    }

    /**
     * Set the value of categorie_id
     *
     * @return  self
     */ 
    public function setCategorie_id($categorie_id)
    {
        $this->categorie_id = $categorie_id;

        return $this;
    }
}
<?php
namespace App\Models;

class CategorieModel extends Model
{
    protected $id;
    protected $nom;

    public function __construct()
    {
        $this->table = 'categorie';
    }

    


     /**
      * Recherche toutes les categories de la table categorie
      *
      * @return array
      */
    public function findCategories()
    {
        return $query = $this->requete("SELECT * FROM categorie")->fetchAll();
        
    }

    public function findByIdCategorie($categorie_id)
    {
        return $this->requete("SELECT nom FROM $this->table WHERE id = $categorie_id")->fetch();
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
}
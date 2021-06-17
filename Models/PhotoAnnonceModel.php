<?php
namespace App\Models;

class PhotoAnnonceModel extends Model
{
    protected $id;
    protected $photo;
    protected $annonce_id;
    protected $statut;

    public function __construct()
    {
        $this->table = 'photo_annonce';
    }

    /**
     * Cherche une photo par rapport à l'id de l'annonce
     *
     * @param string $annonce_id
     * @return 
     */
    public function findPhotoByAnnonceId($annonce_id)
    {
        return $this->requete("SELECT * FROM $this->table WHERE annonce_id = $annonce_id")->fetch();
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
     * Get the value of photo
     */ 
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set the value of photo
     *
     * @return  self
     */ 
    public function setPhoto($photo)
    {
        $this->photo = $photo;

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
     * Get the value of statut
     */ 
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set the value of statut
     *
     * @return  self
     */ 
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }
}
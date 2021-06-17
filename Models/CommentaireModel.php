<?php
namespace App\Models;

class Commentaire extends Model
{
    protected $id;
    protected $note;
    protected $commentaire;
    protected $create_at;
    protected $user_id;
    protected $boutique_particulier_id;
    protected $boutique_pro_id;
    protected $annonce_id;

    public function __construct()
    {
        $this->table = 'commentaire';
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
     * Get the value of note
     */ 
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set the value of note
     *
     * @return  self
     */ 
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get the value of commentaire
     */ 
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set the value of commentaire
     *
     * @return  self
     */ 
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

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
}
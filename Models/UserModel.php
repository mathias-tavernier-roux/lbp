<?php
namespace App\Models;

class UserModel extends Model
{
    protected $id;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $password;
    protected $droit_id;
    

   public function __construct()
   {
       $this->table = 'user';
   }

    // Outil Pour Simplifier La Détection du Type d'Utilisateur
    public function Verify()
    {
        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 1337)
        {
        return "ADMIN";
        }
        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 43)
        {
        return "MODERATEUR";
        }
        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 20)
        {
        return "BOUTIQUE_PRO";
        }
        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 10)
        {
        return "BOUTIQUE_PAR";
        }
        if (isset($_SESSION['user']['droit']) and $_SESSION['user']['droit'] == 1)
        {
        return "USER";
        }
        if (!isset($_SESSION['user']['droit']))
        {
        return "DISCONNECTED";
        }
    }
    
    /** 
     * Crée la session de l'utilisateur
     * @return void 
     */
    public function setSession($boutique_id)
    {
        $_SESSION['user'] = [
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'email' => $this->email,
            'droit' => $this->droit_id,
            'boutique_id' => $boutique_id,            
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
     * Get the value of prenom
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */ 
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

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
}
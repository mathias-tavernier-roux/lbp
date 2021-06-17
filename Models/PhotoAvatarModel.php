<?php
namespace App\Models;

class PhotoAvatarModel extends Model
{
    protected $id;
    protected $user_id;
    protected $boutique_particulier_id;
    protected $boutique_pro_id;
    protected $photo;

    public function __construct()
    {
    $this->table = 'photo_avatar';
    }

    /**
     * Trouve la photo de profil de l'utilisateur grace à user_id
     *
     * @param integer $user_id
     * @return void
     */
    public function findPhotoAvatar(int $user_id)
    {
        return $this->requete("SELECT * FROM $this->table WHERE user_id = ?", [$user_id])->fetch();
    }

    /**
     * Trouve la photo de la boutique de particulier grace à boutique_particulier_id
     *
     * @param integer $boutique_particulier_id
     * @return void
     */
    public function findPhotoBoutiquePar(int $boutique_particulier_id)
    {
        return $this->requete("SELECT * FROM $this->table WHERE boutique_particulier_id = ?", [$boutique_particulier_id])->fetch();
    }

    /**
     * Trouve la photo de la boutique pro grace à boutique_pro_id
     *
     * @param integer $boutique_pro_id
     * @return void
     */
    public function findPhotoBoutique(int $boutique_pro_id)
    {
        return $this->requete("SELECT * FROM $this->table WHERE boutique_pro_id = ?", [$boutique_pro_id])->fetch();
    }

    /**
     * Supprime la photo de l'user
     *
     * @param integer $user_id id de l'user ou de la boutique_particulier
     * @return void
     */
    public function deletePhotoUser(int $user_id)
    {
        return $this->requete("DELETE FROM $this->table WHERE user_id = ?", [$user_id]);
    }

   /**
    * Supprime la photo de la boutique de particulier
    *
    * @param integer $boutique_particulier_id
    * @return void
    */
    public function deletePhotoBoutiquePar($boutique_particulier_id)
    {
        return $this->requete("DELETE FROM $this->table WHERE boutique_particulier_id = ?", [$boutique_particulier_id]);
    }



    /**
     * Supprime la photo de la boutique pro
     *
     * @param integer $boutique_pro_id id de la boutique pro
     * @return void
     */
    public function deletePhotoBoutique(int $boutique_pro_id)
    {
        return $this->requete("DELETE FROM $this->table WHERE user_id = ?", [$boutique_pro_id]);
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
}
<?php
namespace App\Models;

class PhotoAvatarModel extends Model
{
    protected $id;
    protected $user_id;
    protected $boutique_pro_id;
    protected $photo;

    public function __construct()
    {
    $this->table = 'photo_avatar';
    }

    public function findPhotoAvatar(int $user_id)
    {
        return $this->requete("SELECT * FROM $this->table WHERE user_id = ?", [$user_id])->fetch();
    }

    /**
     * Supprime la photo de l'user ou de la boutique_particulier
     *
     * @param integer $user_id id de l'user ou de la boutique_particulier
     * @return void
     */
    public function deletePhotoUser(int $user_id)
    {
        return $this->requete("DELETE FROM $this->table WHERE user_id = ?", [$user_id]);
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
}
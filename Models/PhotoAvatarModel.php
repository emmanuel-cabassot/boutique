<?php
namespace App\Models;

class PhotoAvatarModel extends Model
{
    protected $id;
    protected $user_id;
    protected $photo;

    public function __construct()
    {
    $this->table = 'photo_avatar';
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

}
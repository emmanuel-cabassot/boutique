<?php
namespace App\Models;

class PhotoAvatar extends Model
{
    protected $id;
    protected $boutique_pro_id;
    protected $boutique_particulier_id;

    public function __construct()
    {
    $this->table = 'photo_avatar';
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
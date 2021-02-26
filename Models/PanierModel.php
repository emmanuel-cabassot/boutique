<?php
namespace App\Models;

class PanierModel extends Model
{
    protected $id;
    protected $annonce_id;
    protected $user_id;
    protected $quantite;
    protected $prix_unité
    protected $prix

    public function __construct()
    {
        $this->table = 'panier';
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
     * Get the value of quantite
     */ 
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set the value of quantite
     *
     * @return  self
     */ 
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }
}
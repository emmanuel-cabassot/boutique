<?php
namespace App\Models;

class Commande extends Model
{
    protected $id;
    protected $prix_commande;
    protected $prix_livraison;
    protected $user_id;
    protected $boutique_particulier_id;
    protected $boutique_pro_id;

    public function __construct()
    {
        $this->table = 'commande';
        
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
     * Get the value of prix_commande
     */ 
    public function getPrix_commande()
    {
        return $this->prix_commande;
    }

    /**
     * Set the value of prix_commande
     *
     * @return  self
     */ 
    public function setPrix_commande($prix_commande)
    {
        $this->prix_commande = $prix_commande;

        return $this;
    }

    /**
     * Get the value of prix_livraison
     */ 
    public function getPrix_livraison()
    {
        return $this->prix_livraison;
    }

    /**
     * Set the value of prix_livraison
     *
     * @return  self
     */ 
    public function setPrix_livraison($prix_livraison)
    {
        $this->prix_livraison = $prix_livraison;

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
}
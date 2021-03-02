<?php
namespace App\Models;

class PanierModel extends Model
{
    protected $id;
    protected $annonce_id;
    protected $user_id;
    protected $vendor_id;
    protected $quantite;
    protected $prix_unité;
    protected $prix;

    public function __construct()
    {
        $this->table = 'panier';
    }

    public function view()
    {
        $USER = $_SESSION['user']['id'];
        return $this->requete("SELECT `id`,`annonce_name`,`annonce_id`,`vendor_name`,`quantite`,`prix` FROM `panier` WHERE `user_id` = $USER ORDER BY annonce_id DESC")->fetchAll();
    }

    public function add()
    {
        $ARTNom = $_SESSION['Nom'];
        $ARTId = $_SESSION['IDA'];
        $ARTAcheteur = $_SESSION['user']['id'];
        $ARTVendeur = $_SESSION['Vendeur'];
        $ARTQuantité = $_POST['Quantité'];
        $ARTPrix = $_SESSION['Prix'] * $ARTQuantité;
        $request = "INSERT INTO panier (`user_id`, `annonce_id`, `annonce_name`, `vendor_name`, `quantite`, `prix`) VALUES ($ARTAcheteur, $ARTId, '$ARTNom','$ARTVendeur',$ARTQuantité,$ARTPrix)";
        $this->requeteS($request);
        return $request;
    }

    public function del()
    {
        $TARGET = $_POST['Produit'];
        $USER_TARGET = $_SESSION['user']['id'];
        $request = "DELETE FROM `panier` WHERE `annonce_id` = $TARGET && `user_id` = $USER_TARGET";
        $this->requeteS($request);
        return $request;
    }

    public function edit()
    {
        $TARGET = $_POST['Produit'];
        $USER_TARGET = $_SESSION['user']['id'];
        if ($_POST['EDIT'] == "+")
        {
        $nquentite = $_SESSION['produit_q'][$TARGET] + 1;
        }
        else
        {
        $nquentite = $_SESSION['produit_q'][$TARGET] - 1;
        }
        $nprix = $_SESSION['produit_p'][$TARGET] * $nquentite;
        $request = "UPDATE `panier` SET `quantite`= $nquentite,`prix`= $nprix WHERE `annonce_id` = $TARGET && `user_id` = $USER_TARGET";
        $this->requeteS($request);
        return $request;
    }

    public function delAll()
    {
        $USER_TARGET = $_SESSION['user']['id'];
        $request = "DELETE FROM `panier` WHERE `user_id` = $USER_TARGET";
        $this->requeteS($request);
        return $request;
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
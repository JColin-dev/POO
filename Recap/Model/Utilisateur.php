<?php

namespace Model;

class Utilisateur 
{
    protected $prenom;
    protected $nom;

    public function __construct($prenom,$nom) {
        $this->prenom = $prenom;
        $this->nom = strtoupper($nom);
    }

    public function nomComplet() {
        return $this->getNom(). " " .$this->prenom;
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
     * Get the value of nom
     */ 
    public function getNom()
    {
        return strtoupper($this->nom);
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
}
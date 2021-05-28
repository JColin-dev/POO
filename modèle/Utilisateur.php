<?php

namespace modèle;

class Utilisateur {
    
    //public déclare un droit de lecture pour les autres classes
    //private rend privé une variable pour les autres classes
    //protected peut rendre certaines classes accessibles
    private $nom;
    private $prenom;

    public function __construct($nom, $prenom)
    {
        //$this->nom = strtoupper($nom);
        $this->setNom($nom);
        $this->prenom = $prenom;
    }

    public function nomComplet(){
        return $this->nom." ".$this->prenom;
    }

    //------------- ACCESSEURS --------------

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = strtoupper($nom);
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }
}

//L'encapuslation est le fait d'accéder à des propriétés private via des constructeurs ou des accesseurs
?>
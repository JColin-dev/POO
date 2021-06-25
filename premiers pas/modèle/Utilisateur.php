<?php

namespace modèle;

class Utilisateur {
    
    //public déclare un droit de lecture pour les autres classes
    //private rend privé une variable pour les autres classes
    //protected peut rendre certaines class accessibles
    private $nom;
    private $prenom;
    private $age;

    public function __construct($nom, $prenom, $age)
    {
        //$this->nom = strtoupper($nom);
        $this->setNom($nom);
        $this->prenom = $prenom;
        $this->age = $age;
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
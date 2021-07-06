<?php 

namespace Model;

class Client extends Utilisateur{
    private $numero;

    public function __construct($prenom,$nom,$numero) {
        parent::__construct($prenom,$nom)
        $this->nom = $numero;
    }

    public function code() {
        return $this->nom. $this->numero;
    }

    /**
     * Get the value of numero
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @return  self
     */ 
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }
}
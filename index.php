<?php 
require_once('./modèle/Utilisateur.php');

use modèle\Utilisateur;

    $franck = new Utilisateur("Bansept","Franck");
    //$franck->nom = "BANSEPT";
    //$franck->prenom = "Franck";

    echo $franck->nomComplet();

    $franck->setNom("bansept");
    echo '<br>';
    echo $franck->nomComplet();

?>
<?php 
require_once('./modèle/Utilisateur.php');

use modèle\Utilisateur;

    /*$franck = new Utilisateur("Bansept","Franck");
    //$franck->nom = "BANSEPT";
    //$franck->prenom = "Franck";

    echo $franck->nomComplet();

    $franck->setNom("bansept");
    echo '<br>';
    echo $franck->nomComplet();*/

    $connexion = new PDO('mysql:host=localhost:3306;dbname=cours_poo', 'root', '');
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $resultat = $connexion->query("SELECT * FROM utilisateur");

    $listeUtilisateurBdd = $resultat->fetchAll();
    $listeUtilisateurObjet = [];
    
    foreach($listeUtilisateurBdd as $utilisateurBdd) {
        $utilisateur = new Utilisateur(
            $utilisateurBdd["nom"],
            $utilisateurBdd["prenom"],
            $utilisateurBdd["age"]
        );

        /*$utilisateur = new Utilisateur();
            $utilisateur->setNom($utilisateur['nom']);
            $utilisateur->setPrenom($utilisateur['prenom']);
            $utilisateur->setAge($utilisateur['age']);
        */

        $listeUtilisateurObjet[] = $utilisateur;
    }

    foreach($listeUtilisateurObjet as $utilisateur) {
        echo $utilisateur->nomComplet();
        echo "<br>";
    }

?>
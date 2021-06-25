<?php

namespace controller;

require_once('./modèle/Utilisateur.php');

use modèle\Utilisateur;
use PDO;

class UtilisateurController {

    public function afficheListeUtilisateur() {

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

            $listeUtilisateurObjet[] = $utilisateur;
        }

        require_once("./vue/liste-utilisateur.php");
    }

    public function afficheFormulaire() {
        echo "Affichage du formulaire pour ajouter un utilisateur";
    }

    public function afficheUtilisateur($id) {
        
    }

}

?>
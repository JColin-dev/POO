<?php

use App\Autoloader;

use Model\Utilisateur;

class Application {

    public static function demarrer() {

        include("Autoloader.php");

        Autoloader::register();

        $partiesUrl = explode("/",$_GET["page"]);
        
        $partieUrlController = $partiesUrl[0];

        if(count($partiesUrl) > 1) {
            $partieUrlMethode = $partiesUrl[1];
        } else {
            $partieUrlMethode = "index";
        }

        //ucfirst met en capitale la première lettre
        //dans $nomController il y a Controller/AccueilController dans ce cas
        $nomController = "Controller\\".ucfirst($partieUrlController). "Controller";


        //PHP regarde le texte à l'intérieur de la variable $nomController,
        //il créé un nouvelle objet se basant sur le nom de la classe que contient
        //$nomController (ex : Controller/AccueilController)
        $controller = new $nomController();
        $controller->$partieUrlMethode();
    }

    /*public function demarrer() {
        include("Model/Utilisateur.php");

        $utilisateur = new Utilisateur();

        $utilisateur->setPrenom("John");
        $utilisateur->setNom("Colin");

        echo $utilisateur->nomComplet();
        */
    }


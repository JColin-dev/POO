<?php

use Model\Utilisateur;

class Application
{

    public static function demarrer()
    {
        $partiesUrl = explode("/", $_GET["page"]);

        if (count($partiesUrl) > 0 && $partiesUrl[0] != "") {
            $partieUrlController = $partiesUrl[0];
        } else {
            $partieUrlController = "accueil";
        }

        if (count($partiesUrl) > 1 && $partiesUrl[1] != "") {
            $partieUrlMethode = $partiesUrl[1];
        } else {
            $partieUrlMethode = "index";
        }

        //ucfirst met en capitale la première lettre
        //dans $nomController il y a Controller/AccueilController dans ce cas
        $nomController = "Controller\\" . ucfirst($partieUrlController) . "Controller";

        //si la methode n'existe pas, il renvoie vers la page 404 ou toute autre page qu'on voudrait
        if (!method_exists($nomController, $partieUrlMethode)) {
            $nomController = "Controller\AccueilController";
            $partieUrlMethode = "nonTrouve";

            /*http_response_code(404);
            die();
            */
        }

        //on récupère les potentiels paramètres
        //ex : localhost/.../panier/supprimerArticle/42
        //42 serait à la position 2 du tableau $partiesUrl

        $parametres = array_slice($partiesUrl, 2);

        //PHP regarde le texte à l'intérieur de la variable $nomController,
        //il créé un nouvelle objet se basant sur le nom de la classe que contient
        //$nomController (ex : Controller/AccueilController)
        $controller = new $nomController();
        $controller->$partieUrlMethode($parametres);
    }

    /*public function demarrer() {
        include("Model/Utilisateur.php");

        $utilisateur = new Utilisateur();

        $utilisateur->setPrenom("John");
        $utilisateur->setNom("Colin");

        echo $utilisateur->nomComplet();
        */
}

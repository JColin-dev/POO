<?php 

namespace App;

use App\Model\Utilisateur;

class Application {
    public static function demarrer() {

        //http://localhost/Tests_POO_PHP/Class/article/liste

        $partieUrl = explode("/", $_GET["page"]);

        $nomController = "\\App\\Controller\\".ucfirst($partieUrl[0])."Controller";

        $controleur = new $nomController();

        $controleur->liste();

        /*$nomClass = "App\Model\Utilisateur";

        $utilisateur = new $nomClass("");
        $utilisateur->nomEntier();

        /*$maFonction = "test";
        self::$maFonction();*/

    }

    /*static function test() {
        echo 'ça marche';
    }*/
}
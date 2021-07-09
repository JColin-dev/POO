<?php

namespace Controller;

class BaseController {

    //on utilise la méthode extract et compacte pour transférer plusieurs variables
    //à la vue : les var sont ajoutées dans le tableau "$donnes" dans le controller
    //et sont de nouveau affectée à des var dans cette méthode
    public function afficherVue($fichier = "index", $donnees = []) {

        //extract lit les index du tableau et créé une variables du même nom pour chacun
        //et il affecte la valeur associée
        //ex : si le tableau est ["listeA" => ["a","b","c"], "autreIndex" => 42]
        //il créera une var $listeA contenant ["a","b","c"]
        //et une autre var $autreIndex contenant 42
        extract($donnees);

        $dossier = substr(get_class($this), 11, -10);

        include("./View/".$dossier."/".$fichier.".php");
    }
}
<?php

namespace Controller;

class AccueilController {

    //url : localhost/Tests_POO_PHP/accueil/index ou localhost/Tests_POO_PHP/accueil : c'est ce qu'on veut
    // c'est ce qu'on a la base : localhost/Tests_POO_PHP/index.php.page=nomContoller/nomMethode
    //on le transforme en ça : localhost/Tests_POO_PHP/nomContoller/nomMethode via la réécriture d'url
    public function index() {
        echo "Vous êtes dans l'accueil";
    }
}
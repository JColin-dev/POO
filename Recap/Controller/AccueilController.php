<?php

namespace Controller;
use Model\CLient;
use Model\Utilisateur;

class AccueilController extends BaseController{

    //url : localhost/Tests_POO_PHP/accueil/index ou localhost/Tests_POO_PHP/accueil : c'est ce qu'on veut
    // c'est ce qu'on a la base : localhost/Tests_POO_PHP/index.php.page=nomContoller/nomMethode
    //on le transforme en ça : localhost/Tests_POO_PHP/nomContoller/nomMethode via la réécriture d'url

    public function index() {

        $utilisateur = new Utilisateur("john", "colin");

        echo $utilisateur->nomComplet();

        $this->afficherVue();

        /*$john = new Client();
        $john->setPrenom("John");
        $john->setNom('Colin');
        $john->setNumero(123456);

        echo $john->code();*/

        //si la classe s'appelle Controller\AccueilController
        //on enlève les 11 caractères de Controller\ et les 10 caractères de fin : "Controller"
        //on obtient la chaine "Accueil" dans $dossier
        
    }

    public function nonTrouve() {
        $this->afficherVue("404");
    }
}
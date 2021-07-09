<?php

namespace Controller;

use DAO\ProduitDao;
use DAO\UtilisateurDao;
use Model\Client;
use Model\Utilisateur;

class AccueilController extends BaseController
{

    //url : localhost/Tests_POO_PHP/accueil/index ou localhost/Tests_POO_PHP/accueil : c'est ce qu'on veut
    // c'est ce qu'on a la base : localhost/Tests_POO_PHP/index.php.page=nomContoller/nomMethode
    //on le transforme en ça : localhost/Tests_POO_PHP/nomContoller/nomMethode via la réécriture d'url

    public function index()
    {

        $dao = new ProduitDao();

        $listeProduits = $dao->findAll();

        $dao = new UtilisateurDao();

        $listeUtilisateurs = $dao->findAll();

        $donnees = compact('listeProduits', "listeUtilisateurs");

        $this->afficherVue('index', $donnees);

        //echo $listeUtilisateurs[0]->nomComplet();

        //$client = new Client("john", "colin", "12345");
        //echo $client->code();

        //echo $client->nomComplet();

        /*$john = new Client();
        $john->setPrenom("John");
        $john->setNom('Colin');
        $john->setNumero(123456);

        echo $john->code();*/

        //si la classe s'appelle Controller\AccueilController
        //on enlève les 11 caractères de Controller\ et les 10 caractères de fin : "Controller"
        //on obtient la chaine "Accueil" dans $dossier

    }

    public function nonTrouve()
    {
        $this->afficherVue("404");
    }
}

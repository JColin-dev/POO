<?php

namespace Controller;

use DAO\ProduitDao;

class PanierController extends BaseController {

    public function index() {

        $dao = new ProduitDao();

        $listeProduits = $dao->findAll();

        $donnees = compact('listeProduits');
        $this->afficherVue('index', $donnees);
    }

    public function supprimerArticle($parametres) {
        echo "Suppression de l'article avec l'id ";
        echo $parametres[0]."<br>";
        echo "L'article est bien supprimé";
    }
}

<?php 

namespace Controller;

use DAO\OffreDao;
use Model\Offre;

class OffreController extends BaseController{
    public function index() {
        $this->afficherVue("form_offre");
    }
    public function afficheOffre() {
        $dao = new OffreDao();

        $listeOffres = $dao->findAll();

        $donnees = compact('listeOffres');
        $this->afficherVue('offre', $donnees);
    }

    public function insertionOffre() {
        $dao = new OffreDao();

        $dao->insertOffer($_POST["titre"], $_POST["description"]);
    }

    public function afficheOneOffre() {
        $dao = new OffreDao();
        
        $listeOffres = $dao->findByOffer($_POST["offre"]);

        $donnees = compact("listeOffres");
        $this->afficherVue('offre', $donnees);
    }

    public function supprimerOffre($parametres) {
        $dao = new OffreDao;
        $dao->deleteById($parametres[0]);
    }

}
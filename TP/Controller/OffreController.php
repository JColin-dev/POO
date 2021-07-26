<?php 

namespace Controller;

use DAO\OffreDao;
use Model\Offre;

class OffreController extends BaseController{
    public function index($parametres) {
        $modification = false;

        $parametres = compact("modification");

        $this->afficherVue("form_offre", $parametres);
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

    public function modifierOffre($parametres) {
        
        if(isset($_POST["titre"])) {
            
            $dao = new OffreDao;
            $dao->modifyById($_POST["id"], $_POST["titre"], $_POST["description"]);
        } else {
            $modification = true;
            $dao = new OffreDao();
            $id = $parametres[0];
            $offre = $dao->findById($id);
            $parametres = compact("modification", "id", "offre");
            $this->afficherVue("form_offre", $parametres);
        }
    }

    public function voirPlus ($parametres) {
        $dao = new OffreDao();

        $offre = $dao->findById($parametres[0]);

        $donnees = compact('offre');
        $this->afficherVue('detailOffre', $donnees);

    }

}
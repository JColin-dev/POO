<?php
namespace Controller;
use DAO\ProduitDao;

class ProduitController {
    public function supprimerProduit($parametres) {
        $dao =new ProduitDao();

        $dao->deleteById($parametres[0]);
    }

    public function modifierProduit($id) {
        $dao = new ProduitDao();
        $dao->updateById($id);
    }
}
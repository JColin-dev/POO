<?php

namespace Controller;

use Dao\CompetenceDao;
use DAO\OffreDao;
use Model\Offre;

class OffreController extends BaseController
{
    public function index($parametres)
    {
        $modification = false;

        $utilisateur = unserialize($_SESSION['utilisateur']);
        $idUtilisateurConnecte = $utilisateur->getId();

        $dao = new CompetenceDao();
        
        $listeCompetence = $dao->findAll();

        $donnees = compact("listeCompetence", "utilisateur", "modification", "idUtilisateurConnecte");
        $this->afficherVue("form_offre", $donnees);
    }
    public function afficheOffre()
    {
        $dao = new OffreDao();
        $listeOffres = $dao->findAllWithInfo();
    
        $donnees = compact('listeOffres');
        $this->afficherVue('offre', $donnees);
    }

    public function insertionOffre()
    {
        $dao = new OffreDao();

        $utilisateur = unserialize($_SESSION['utilisateur']);
        $idUtilisateurConnecte = $utilisateur->getId();

        $dao->insertOffer($_POST["titre"], $_POST["description"], $_POST["competence"], $idUtilisateurConnecte);
    }

    public function afficheOneOffre()
    {
        $dao = new OffreDao();

        $listeOffres = $dao->findByOffer($_POST["offre"]);

        $donnees = compact("listeOffres");
        $this->afficherVue('offre', $donnees);
    }

    public function supprimerOffre($parametres)
    {
        $dao = new OffreDao;
        $dao->deleteById($parametres[0]);
    }

    public function modifierOffre($parametres)
    {

        if (isset($_POST["titre"])) {

            $id = $parametres[0];

            $dao = new OffreDao;
            $dao->modifyById($parametres[0], $_POST["titre"], $_POST["description"]);

            //si l'utilisateur a selectionné une compétence dans la liste déroulante
            if($_POST["competence"] != "") {
                $dao->ajouterCompetence($parametres[0], $_POST["competence"]);
            }
            
        } else {
            $modification = true;

            $dao = new CompetenceDao();
            $id = $parametres[0];
            $listeCompetenceOffre = $dao->findCompetence($id);
            $listeCompetence = $dao->findAllNonAttribueeOffre($id);

            $dao = new OffreDao();
            $id = $parametres[0];
            $offre = $dao->findById($id);
            
            $parametres = compact("modification", "id", "offre", "listeCompetence", "listeCompetenceOffre");
            $this->afficherVue("form_offre", $parametres);
        }
    }

    public function voirPlus($parametres)
    {
        $dao = new OffreDao();

        $offre = $dao->findById($parametres[0]);

        $donnees = compact('offre');
        $this->afficherVue('detailOffre', $donnees);
    }

    public function supprimerCompetence($parametres) {
        $idOffre = $parametres[0];
        $idCompetence= $parametres[1];

        $daoOffre = new OffreDao();

        $idUtilisateurOffre = $daoOffre->findByIdAvecUtilisateur($idOffre);
        $utilisateur = unserialize($_SESSION['utilisateur']);
        $idUtilisateurConnecte = $utilisateur->getId();

        if($idUtilisateurOffre == $idUtilisateurConnecte) {
            $daoOffre->supprimerCompetence($idOffre, $idCompetence);
            $this->afficherMessage("La compétence a bien été supprimée", "success");
        } else {
            $this->afficherMessage("Vous ne pouvez pas modifier cette offre", "danger");
        }

        $this->redirection("offre/modifierOffre/" .$idOffre);
    }

    
}

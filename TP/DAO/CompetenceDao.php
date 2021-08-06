<?php 

namespace Dao;

use Connexion;
use DAO\BaseDao;

class CompetenceDao extends BaseDao {

    public function findByIdUtilisateur($idUtilisateur) {

        $connexion = new Connexion();

        $requete = $connexion->prepare("SELECT c.id, c.designation
        FROM competence c 
        JOIN competence_utilisateur cu ON c.id = cu.id_competence 
        WHERE cu.id_utilisateur = :idUtilisateur ");

        $requete->execute([":idUtilisateur" => $idUtilisateur]);

        $listeCompetence = [];

        //pour chaque ligne de la table
        foreach ($requete->fetchAll() as $ligneCompetence) {
            $listeCompetence[] = $this->transformeTableauEnObjet($ligneCompetence);
        }
        return $listeCompetence;
    }

    public function findCompetence($id)
    {
        $connexion = new Connexion;

        $requete = $connexion->prepare("SELECT * FROM competence_offre co
        JOIN competence c 
        ON c.id = co.id_competence WHERE co.id_offre=?");
        $requete->execute(array(
            $id
        ));
        $listeCompetence = [];

        //pour chaque ligne de la table
        foreach ($requete->fetchAll() as $ligneCompetence) {
            $listeCompetence[] = $this->transformeTableauEnObjet($ligneCompetence);
        }
        return $listeCompetence;
    }

    public function findAllNonAttribueeOffre($idOffre)
    {
        $connexion = new Connexion;

        $requete = $connexion->prepare("SELECT * FROM competence c
        WHERE c.id NOT IN (
        SELECT co.id_competence
        FROM competence_offre co 
        WHERE co.id_offre = ?)");
        $requete->execute(array(
            $idOffre
        ));

        $listeCompetence = [];

        //pour chaque ligne de la table
        foreach ($requete->fetchAll() as $ligneCompetence) {
            $listeCompetence[] = $this->transformeTableauEnObjet($ligneCompetence);
        }
        return $listeCompetence;
    }
}


?>
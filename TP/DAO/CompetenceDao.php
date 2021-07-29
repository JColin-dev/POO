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
}


?>
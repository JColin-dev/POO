<?php

namespace DAO;

use Model\Utilisateur;
use Connexion;
use Model\Competence;
use Model\Domaine;
use PDOException;

class OffreDao extends BaseDao
{
    public function findByOffer($recherche)
    {
        try {
            $connexion = new Connexion();

            $requete = $connexion->prepare("SELECT o.id, o.titre, o.description, o.id_utilisateur, u.pseudo, o.id_domaine, d.designation
            FROM offre o 
            JOIN utilisateur u ON o.id_utilisateur = u.id 
            LEFT JOIN domaine d ON o.id_domaine = d.id
            WHERE description LIKE :recherche 
            OR titre LIKE :recherche 
            OR pseudo LIKE :recherche
            OR designation LIKE :recherche");

            $requete->execute(
                [
                    "recherche" => "%" . $recherche . "%"
                ]
            );

            $listeOffres = [];

            //pour chaque ligne de la table
            foreach ($requete->fetchAll() as $ligneResultat) {

                $offre = $this->transformeTableauEnObjet($ligneResultat);

                $utilisateur = new Utilisateur();
                $utilisateur->setId($ligneResultat['id_utilisateur']);
                $utilisateur->setPseudo($ligneResultat['pseudo']);
                $offre->setUtilisateur($utilisateur);

                $domaine = new Domaine();
                $domaine->setId($ligneResultat['id_domaine']);
                $domaine->setDesignation($ligneResultat['designation']);
                $offre->setDomaine($domaine);

                $listeOffres[] = $offre;
            }
            return $listeOffres;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insertOffer($titre, $description, $competence, $idUtilisateur)
    {
        try {
            $connexion = new Connexion();

            $requete = $connexion->prepare("INSERT INTO offre (titre, description, id_utilisateur) VALUES (?,?,?)");
            $requete->execute(array(
                $titre,
                $description,
                $idUtilisateur
            ));
            $idOffre = $connexion->lastInsertId();
            $requete = $connexion->prepare('INSERT INTO competence_offre (id_offre, id_competence) VALUES (?,?)');
            $requete->execute(array(
                $idOffre,
                $competence
            ));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function modifyById($id, $titre, $description)
    {

        $sql = "UPDATE offre SET titre = :titre, description = :description WHERE id = :id";

        try {
            $connexion = new Connexion();

            $requete = $connexion->prepare($sql);

            $requete->execute(
                [
                    ":titre" => $titre,
                    ":description" => $description,
                    ":id" => $id
                ]
            );
        } catch (PDOException $e) {
            echo "erreur... :(" . $e->getMessage();
        }
    }

    public function findAllWithInfo() {
        $connexion = new Connexion();

        $resultat = $connexion->query("SELECT o.id, o.titre, o.description, o.id_utilisateur, u.pseudo, o.id_domaine, d.designation, c.designation as 'designation_competence'
        FROM offre o 
        JOIN utilisateur u ON o.id_utilisateur = u.id
        LEFT JOIN domaine d ON o.id_domaine = d.id
        LEFT JOIN competence_offre co ON co.id_offre = o.id
        LEFT JOIN competence c ON co.id_competence = c.id");

        $listeOffres = [];

        //pour chaque ligne de la table
        foreach ($resultat->fetchAll() as $ligneResultat) {

            $offre = $this->transformeTableauEnObjet($ligneResultat);

            $utilisateur = new Utilisateur();
            $utilisateur->setId($ligneResultat['id_utilisateur']);
            $utilisateur->setPseudo($ligneResultat['pseudo']);
            $offre->setUtilisateur($utilisateur);

            $domaine = new Domaine();
            $domaine->setId($ligneResultat['id_domaine']);
            $domaine->setDesignation($ligneResultat['designation']);
            $offre->setDomaine($domaine);

            $competence = new Competence();
            $competence->setId($ligneResultat['id']);
            $competence->setDesignation($ligneResultat['designation_competence']);
            
            //si on a déjà ajouter une offre ayant cet ID
            //on se contente d'ajouter la compétence à l'offre déjà créée
            if(isset($listeOffres[$offre->getId()])) {
                $listeOffres[$offre->getId()]->ajoutCompetence($competence);
                //sinon on ajoute l'offre à la liste
            } else {
                $offre->ajoutCompetence($competence);
                $listeOffres[$offre->getId()] = $offre;
            }
        }

        return $listeOffres;
    }

    public function ajouterCompetence($idOffre, $idCompetence) {
        $connexion = new Connexion;

        $requete = $connexion->prepare("INSERT INTO competence_offre(id_competence, id_offre) 
        VALUES (:id_competence, :id_offre)");

        $requete->execute([
            "id_competence" => $idCompetence,
            "id_offre" => $idOffre
        ]);
    }

    public function supprimerCompetence($idOffre, $idCompetence) {
        $connexion = new Connexion;

        $requete = $connexion->prepare("DELETE FROM competence_offre 
        WHERE id_competence = :id_competence
        AND id_offre = :id_offre");

        $requete->execute([
            "id_competence" => $idCompetence,
            "id_offre" => $idOffre
        ]);
    }

    public function findByIdAvecUtilisateur($idOffre)
    {
        $connexion = new Connexion;

        $requete = $connexion->prepare("SELECT id_utilisateur
        FROM offre
        WHERE id= :id_offre");

        $requete->execute([
            "id_offre" => $idOffre
        ]);

        $offre = $requete->fetch();
        return $offre["id_utilisateur"];
    }

    

}

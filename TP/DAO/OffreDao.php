<?php

namespace DAO;

use Model\Utilisateur;
use Connexion;
use PDOException;

class OffreDao extends BaseDao
{
    public function findByOffer($recherche)
    {
        try {
            $connexion = new Connexion();

            $requete = $connexion->prepare("SELECT o.id, o.titre, o.description, o.id_utilisateur, u.pseudo 
            FROM offre o 
            JOIN utilisateur u ON o.id_utilisateur = u.id 
            WHERE description LIKE :recherche OR titre LIKE :recherche OR pseudo LIKE :recherche");

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

                $listeOffres[] = $offre;
            }
            return $listeOffres;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insertOffer($titre, $description)
    {
        try {
            $connexion = new Connexion();

            $requete = $connexion->prepare("INSERT INTO offre (titre, description) VALUES (?,?)");
            $requete->execute(array(
                $titre,
                $description
            ));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function modifyById($id, $titre, $description)
    {

        $sql = "UPDATE " . $this->getNomTable() . " SET titre = :titre, description = :description WHERE id = :id";

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

    public function findAllWithUser() {
        $connexion = new Connexion();

        $resultat = $connexion->query("SELECT o.id, o.titre, o.description, o.id_utilisateur, u.pseudo FROM offre o JOIN utilisateur u ON o.id_utilisateur = u.id");

        $listeOffres = [];

        //pour chaque ligne de la table
        foreach ($resultat->fetchAll() as $ligneResultat) {

            $offre = $this->transformeTableauEnObjet($ligneResultat);

            $utilisateur = new Utilisateur();
            $utilisateur->setId($ligneResultat['id_utilisateur']);
            $utilisateur->setPseudo($ligneResultat['pseudo']);

            $offre->setUtilisateur($utilisateur);

            $listeOffres[] = $offre;
        }

        return $listeOffres;
    }
}

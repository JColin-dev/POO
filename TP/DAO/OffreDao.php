<?php

namespace DAO;

use Connexion;
use PDOException;

class OffreDao extends BaseDao
{
    public function findByOffer($recherche)
    {
        try {
            $connexion = new Connexion();

            $requete = $connexion->prepare("SELECT * FROM offre WHERE description LIKE :recherche OR titre LIKE :recherche");

            $requete->execute(
                [
                    "recherche" => "%" . $recherche . "%"
                ]
            );

            $listeOffres = [];

            //pour chaque ligne de la table
            foreach ($requete->fetchAll() as $ligneResultat) {

                $offre = $this->transformeTableauEnObjet($ligneResultat);

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
}

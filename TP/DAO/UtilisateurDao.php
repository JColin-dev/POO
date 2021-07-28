<?php

namespace DAO;

use Connexion;
use PDOException;

class UtilisateurDao extends BaseDao
{
    public function findByPseudo($pseudo)
    {
        try {
            $connexion = new Connexion();

            $requete = $connexion->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");

            $requete->execute(
                [
                    ":pseudo" => $pseudo
                ]
            );

            return $this->transformeTableauEnObjet($requete->fetch());
        } catch (PDOException $e) {
            echo "erreur... :(";
        }
    }

    public function insertUser($pseudo, $password, $email, $entreprise)
    {
        try {
            $connexion = new Connexion();


            $requete = $connexion->prepare("INSERT INTO utilisateur (pseudo, email, mot_de_passe, entreprise) 
            VALUES (?,?,?,?)");
            $requete->execute(array(
                $pseudo,
                $email,
                password_hash($password, PASSWORD_BCRYPT),
                $entreprise ? 1 : 0
            ));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

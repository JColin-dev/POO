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

    public function modifyUser($id, $pseudo, $nomAvatar)
    {

        

        try {
            $connexion = new Connexion();

            if($nomAvatar != "") {

                $requete = $connexion->prepare("UPDATE utilisateur SET pseudo = ?, nom_avatar = ? WHERE id = ?");

                $requete->execute(
                    [
                        $pseudo,
                        $nomAvatar,
                        $id
                    ]
                );
            } else {
                $requete = $connexion->prepare("UPDATE utilisateur SET pseudo = ? WHERE id = ?");

                $requete->execute(
                    [
                        $pseudo,
                        $id
                    ]
                );
            }
        } catch (PDOException $e) {
            echo "erreur... :(" . $e->getMessage();
        }
    }

    public function ajouterCompetenceUtilisateur($idUtilisateur, $idCompetence){
        $sql = "INSERT INTO competence_utilisateur (id_competence, id_utilisateur) VALUES(?,?)";

        try {
            $connexion = new Connexion();

            $requete = $connexion->prepare($sql);

            $requete->execute(
                [
                    $idCompetence,
                    $idUtilisateur
                ]
            );
        } catch (PDOException $e) {
            echo "erreur... :(" . $e->getMessage();
        }
    }

    public function supprimerCompetenceUtilisateur($idCompetence, $idUtilisateur)
    {
        $connexion = new Connexion();
        $requete = $connexion->prepare(
            "DELETE FROM competence_utilisateur WHERE id_competence = ? AND id_utilisateur = ?"
        );

        $requete->execute(
            [
                $idCompetence,
                $idUtilisateur
            ]
        );
    }
}

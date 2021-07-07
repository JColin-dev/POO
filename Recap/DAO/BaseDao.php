<?php

namespace DAO;

use Connexion;


class BaseDao
{
    public function findAll()
    {
        $connexion = new Connexion();

        //si la classe s'appelle DAO\UtilisateurDao, $table contiendra utilisateur
        $table = strtolower(substr(get_class($this), 4, -3));


        $resultat = $connexion->query("SELECT * FROM " . $table);

        $listeUtilisateurs = [];

        $nomClasseModel = "Model\\" . ucfirst($table);

        //pour chaque ligne de la table
        foreach ($resultat->fetchAll() as $ligneResultat) {

            //on créé une instance de la classe 
            $model = new $nomClasseModel();

            //pour chaque index du tableau $ligneResultat
            foreach ($ligneResultat as $key => $valeur) {

                //on en déduit le setter
                $nomSetter = "set" . ucfirst($key);

                //si le setter existe bien
                if (method_exists($nomClasseModel, $nomSetter)) {
                    $model->$nomSetter($valeur);
                }
            }
            $listeUtilisateurs[] = $model;
        }

        return $listeUtilisateurs;
    }
}

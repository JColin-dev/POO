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

        foreach ($resultat->fetchAll() as $ligneResultat) {

            $model = new $nomClasseModel();

            foreach ($ligneResultat as $key => $valeur) {
                $nomSetter = "set" . ucfirst($key);

                if (method_exists($nomClasseModel, $nomSetter)) {
                    $model->$nomSetter($valeur);
                }
            }
        }

        return $listeUtilisateurs;
    }
}

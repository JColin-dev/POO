<?php

namespace Controller;

use DAO\UtilisateurDao;

class UtilisateurController extends BaseController
{
    public function index()
    {
        $this->afficherVue("login");
    }

    public function connexion()
    {
        $dao = new UtilisateurDao();

        //pour générer un mot de passe et le copier
        //echo password_hash("azerty", PASSWORD_BCRYPT);

        $utilisateur = $dao->findByPseudo($_POST["pseudo"]);

        if(password_verify($_POST["password"], $utilisateur->getMotDePasse())) {
            $_SESSION["utilisateur"] = serialize($utilisateur);

            //On redirige vers l'accueil
            header("Location: /Tests_POO_PHP/Recap");
        } else {
            echo "mauvais mot de passe";
        }
    }
}

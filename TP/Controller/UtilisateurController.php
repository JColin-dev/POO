<?php

namespace Controller;

use DAO\UtilisateurDao;

class UtilisateurController extends BaseController
{

    public function connexion()
    {
        $dao = new UtilisateurDao();

        

        if (isset($_POST["pseudo"])) {
            $utilisateur = $dao->findByPseudo($_POST["pseudo"]);

            if (password_verify($_POST["password"], $utilisateur->getMotDePasse())) {
                $_SESSION["utilisateur"] = serialize($utilisateur);
                header("Location: /TP_POO_PHP/POO/TP");
            } else {
                echo "mauvais mot de passe";
            }
        } else {
            $this->afficherVue("login");
        }
    }

    public function deconnexion()
    {
        session_unset();
        session_destroy();
        header("Location: /TP_POO_PHP/POO/TP");
    }

    public function inscription()
    {
        $pseudo = "";
        $entreprise = false;

        if (isset($_POST["pseudo"])) {
            $pseudo = $_POST["pseudo"];
            $entreprise = isset($_POST['entreprise']);
            
            $dao = new UtilisateurDao();
            $dao->insertUser($_POST["pseudo"], $_POST["password"], $_POST["email"], isset($_POST["entreprise"]));

            header("Location: /TP_POO_PHP/POO/TP/utilisateur/connexion");

        } else {
            $donnees = compact('pseudo', 'entreprise');
          $this->afficherVue("inscription", $donnees);
        }
    }
}

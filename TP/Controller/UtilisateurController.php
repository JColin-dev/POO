<?php

namespace Controller;

use Dao\CompetenceDao;
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
                $this->afficherMessage('Vous êtes bien connecté', 'success');
                $this->redirection();
            } else {
                $this->afficherMessage('Mauvais mot de passe', 'danger');
            }
        }

        $this->afficherVue("login");
    }

    public function deconnexion()
    {
        session_unset();
        session_destroy();
        session_start();
        $this->afficherMessage('Vous êtes bien déconnecté', 'success');
        $this->redirection();
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

            $this->afficherMessage('Vous êtes bien inscrit', 'success');
            $this->redirection("utilisateur/connexion");   
        }
        $donnees = compact('pseudo', 'entreprise');
        $this->afficherVue("inscription", $donnees);
    }

    public function profil() {
        $utilisateur = unserialize($_SESSION['utilisateur']);
        $idUtilisateurConnecte = $utilisateur->getId();

        $dao = new CompetenceDao();
        $listeCompetence = $dao->findByIdUtilisateur($idUtilisateurConnecte);

        $donnees = compact("listeCompetence", "utilisateur");
        $this->afficherVue("profil", $donnees);
        
    }
}

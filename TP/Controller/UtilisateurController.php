<?php

namespace Controller;

use Model\Utilisateur;
use Connexion;
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

        $erreurAvatar = "";
        $erreurPseudo = "";

        $utilisateur = unserialize($_SESSION['utilisateur']);
        $idUtilisateurConnecte = $utilisateur->getId();

        if(isset($_POST["pseudo"])) {

            $utilisateurDao = new UtilisateurDao();
            
            if(strlen($_POST["pseudo"]) < 3) {
                $erreurPseudo = "Votre pseudo doit contenir au moins 3 caractères";
            }

            if($_POST["competence"] != "") {
                $utilisateurDao->ajouterCompetenceUtilisateur(
                    $idUtilisateurConnecte,
                    $_POST["competence"]
                );
            }

            $nomAvatar = "";

            if($_FILES['avatar']['name'] != "") {

                $nomOrigine = $_FILES['avatar']['name'];

                $decoupageNomOrigine = explode(".", $nomOrigine);
                //on récupère la dernière partie du nom, cad l'extension
                //la fonction end retourne le dernier élément d'un tableau
                $extension = strtolower(end($decoupageNomOrigine));

                $listeExtensionsValides = ["jpg", "png", "jpeg"];

                if(in_array($extension, $listeExtensionsValides)) {

                    $nomTemporaireAvatar = $_FILES['avatar']['tmp_name'];

                    $nomAvatar = $_POST["pseudo"]. "_" . $nomOrigine;

                    move_uploaded_file(
                        $nomTemporaireAvatar,
                        "./upload/" . $nomAvatar
                    );
                } else {
                    $erreurAvatar = "L'extension doit être jpeg ou png";
                }
            }

            if($erreurPseudo == "" && $erreurAvatar == "") {

            $utilisateurDao->modifyUser($idUtilisateurConnecte, $_POST["pseudo"], $nomAvatar);

            $nouvelUtilisateur = new Utilisateur();
            $nouvelUtilisateur->setId($idUtilisateurConnecte);
            $nouvelUtilisateur->setPseudo($_POST["pseudo"]);
            $nouvelUtilisateur->setNomAvatar($nomAvatar == "" ? $utilisateur->getNomAvatar() : $nomAvatar);

            $_SESSION["utilisateur"] = serialize($nouvelUtilisateur);

            $this->afficherMessage("Votre profil a bien été mis à jour");

            } else {
                $this->afficherMessage("Certains champs comportent des erreurs", "warning");
            }
        }

        $dao = new CompetenceDao();
        $listeCompetenceUtilisateur = $dao->findByIdUtilisateur($idUtilisateurConnecte);

        $listeCompetence = $dao->findAll();

        $listeCompetenceNonAttribuee = [];

        //poir chaque competence de la table competence
        foreach($listeCompetence as $competence) {
            $dejaAttribuee = false;

            //on vérifie si l'utilisateur a déjà cette compétence parmi toutes ses compétences
            foreach($listeCompetenceUtilisateur as $competenceUtilisateur) {
                if($competence->getId() == $competenceUtilisateur->getId()) {
                    $dejaAttribuee = true;
                    //on sort du foreach, il est inutile de chercher plus loin puisque le doublon a été trouvé
                    break;
                }
            }

            if(!$dejaAttribuee) {
                $listeCompetenceNonAttribuee[] = $competence;
            }
        }

        $donnees = compact(
            "listeCompetenceUtilisateur", 
        "listeCompetenceNonAttribuee", 
        "utilisateur", 
        "erreurAvatar",
        "erreurPseudo"
        );
        
        $this->afficherVue("profil", $donnees);
        
    }

    public function supprimerCompetence($parametres) {
        $idCompetence = $parametres[0];

        $utilisateur = unserialize($_SESSION['utilisateur']);
        $idUtilisateurConnecte = $utilisateur->getId();

        $dao = new UtilisateurDao();
        $dao->supprimerCompetenceUtilisateur($idCompetence, $idUtilisateurConnecte);
    
    }
}

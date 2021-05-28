<?php

require_once("./controleur/UtilisateurController.php");

use controller\UtilisateurController;

$nomController = "\\controller\\".ucfirst($_GET["page"])."Controller";

$controlleur = new $nomController();

$controlleur->afficheListeUtilisateur();

?>
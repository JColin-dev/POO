<?php

require_once("./controleur/UtilisateurController.php");

//explode coupe en deux les URLs séparé par le slash
$partieUrl = explode("/",$_GET["page"]);
$partieController = $partieUrl[0];
$partieMethode = $partieUrl[1];

$nomController = "\\controller\\".ucfirst($partieController)."Controller";

$controlleur = new $nomController();

$nomMethode = "afficheListeUtilisateur";

$controlleur->$partieMethode();

?>
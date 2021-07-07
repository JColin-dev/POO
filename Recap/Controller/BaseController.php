<?php

namespace Controller;

class BaseController {
    public function afficherVue($fichier = "index", $donnees = []) {

        $dossier = substr(get_class($this), 11, -10);

        include("./View/".$dossier."/".$fichier.".php");
    }
}
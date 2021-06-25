<?php 

namespace App;

use model\Utilisateur;

class Application {
    public static function demarrer() {

        $john = new Utilisateur("john");
        // $john = new model\Utilisateur("john"); cela marche aussi

        $john->nomEntier();


    }
}
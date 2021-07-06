<?php 

class Connexion extends PDO{
    public function __construct() {
        parent::__construct("mysql:dbname=Recap;host=localhost::3306", "root", "");
    }
}


?>
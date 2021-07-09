<?php

session_start();

include("Autoloader.php");

use App\Autoloader;

Autoloader::register();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/5/cerulean/bootstrap.min.css">
    <link rel="stylesheet" href="/Tests_POO_PHP/Recap/assets/css/style.css">
    <title>E-commerce</title>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="/Tests_POO_PHP/Recap/">Paraflotte</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarColor02">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="/Tests_POO_PHP/Recap/">Accueil
                                <span class="visually-hidden">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Tests_POO_PHP/Recap/panier/index">Parapluies pas cher</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Parapluies de luxe</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Tests_POO_PHP/Recap/utilisateur/contact">Contact</a>
                        </li>
                        <li class="nav-item">
                            <?php

                            $utilisateur = NULL;

                            if (isset($_SESSION["utilisateur"])) {

                                $utilisateur = unserialize($_SESSION["utilisateur"]); ?>

                                <a class="nav-link" href="#"> Bienvenue <?php echo $utilisateur->nomComplet(); ?> !</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/Tests_POO_PHP/Recap/utilisateur/deconnexion">Déconnexion</a>
                        </li>

                    <?php } else { ?>

                        <li class="nav-item">
                            <a class="nav-link" href="/Tests_POO_PHP/Recap/utilisateur">Se connecter</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/Tests_POO_PHP/Recap/utilisateur/inscription">Inscription</a>
                        </li>
                    <?php } ?>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-sm-2" type="text" placeholder="Rechercher">
                        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Recherche</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <?php

    Application::demarrer();

    ?>

</body>

</html>
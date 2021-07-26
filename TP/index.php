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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js" integrity="sha512-a6ctI6w1kg3J4dSjknHj3aWLEbjitAXAjLDRUxo2wyYmDFRcz2RJuQr5M3Kt8O/TtUSp8n2rAyaXYy1sjoKmrQ==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
    <link rel="stylesheet" href="https://bootswatch.com/5/cosmo/bootstrap.min.css">
    <link rel="stylesheet" href="/TP_POO_PHP/POO/TP/assets/css/style.css">
    <title>Paul Emploi</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="/TP_POO_PHP/POO/TP">Paul Emploi</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarColor02">
                    <ul class="navbar-nav me-auto">

                        <?php

                        if (isset($_SESSION["utilisateur"])) {

                            $utilisateur = unserialize($_SESSION["utilisateur"]);

                            if ($utilisateur->getEntreprise()) { ?>

                                <li class="nav-item">
                                    <a class="nav-link" href="/TP_POO_PHP/POO/TP/Offre/index">Ajouter offre</a>
                                </li>
                                <li class="nav-item">

                                <li class="nav-item">
                                    <a class="nav-link" href="/TP_POO_PHP/POO/TP/Offre/afficheOffre">Offres</a>
                                </li>
                            <?php } else { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/TP_POO_PHP/POO/TP/Offre/afficheOffre">Offres</a>
                                </li>
                            <?php }
                        }



                        $utilisateur = NULL;

                        if (isset($_SESSION["utilisateur"])) {

                            ?>

                            <a class="nav-link" href="/TP_POO_PHP/POO/TP/utilisateur/deconnexion">Déconnexion</a>
                            </li>

                        <?php } else { ?>

                            <li class="nav-item">
                                <a class="nav-link" href="/TP_POO_PHP/POO/TP/utilisateur/connexion">Connexion</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/TP_POO_PHP/POO/TP/utilisateur/inscription">Inscription</a>
                            </li>
                        <?php } ?>
                    </ul>
                    <form class="d-flex" method="post" action="/TP_POO_PHP/POO/TP/offre/afficheOneOffre">
                        <input class=" form-control me-sm-2" type="text" placeholder="Rechercher" name="offre">
                        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Rechercher une offre</button>
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
<h1 class="liste">Liste des offres</h1>
<div class="offre">

    <?php

    foreach ($listeOffres as $offre) {

    ?>
        <div class="carte">
            <div class="card border-dark mb-3" style="max-width: 20rem;">
                <div class="card-header"><?php echo $offre->getTitre(); ?>, Publié par : <?php echo $offre->getUtilisateur()->getPseudo(); ?></div>
                <div class="card-body">
                    <p class="card-text"><?php echo substr($offre->getDescription(),0,200); ?></p>
                </div>
                <a type="button" class="btn btn-primary" href="/TP_POO_PHP/POO/TP/Offre/voirPlus/<?php echo $offre->getId(); ?>">Voir plus </a>
                <?php

                if (isset($_SESSION["utilisateur"])) {

                    $utilisateur = unserialize($_SESSION["utilisateur"]);

                    if ($utilisateur->getEntreprise()) { ?>
                        <a type="button" class="btn btn-primary" href="/TP_POO_PHP/POO/TP/Offre/modifierOffre/<?php echo $offre->getId(); ?>">Modifier </a>
                        <a type="button" class="btn btn-primary" href="/TP_POO_PHP/POO/TP/Offre/supprimerOffre/<?php echo $offre->getId(); ?>">Supprimer </a>
                <?php }
                } ?>
            </div>
        </div>
    <?php
    }

    ?>
</div>
<h1 class="liste">Liste des offres</h1>
<div class="offre">

    <?php

    foreach ($listeOffres as $offre) {

    ?>
        <div class="carte">
            <div class="card border-dark mb-3" style="max-width: 20rem;">
                <div class="card-header"><?php echo $offre->getTitre(); ?></div>
                <div class="card-body">
                    <p class="card-text"><?php echo $offre->getDescription(); ?></p>
                </div>
                <a type="button" class="btn btn-primary disabled" href="/TP_POO_PHP/POO/TP/Offre/supprimerOffre/<?php echo $offre->getId(); ?>">Supprimer </a>
            </div>
        </div>
    <?php
    }

    ?>
</div>
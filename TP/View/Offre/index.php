<div class="carte">
    <div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
        <div class="card-header"><?php echo $offre->getTitre(); ?></div>
        <div class="card-body">
            <p class="card-text"><?php echo $offre->getDescription(); ?></p>
        </div>
        <a type="button" class="btn btn-warning" href=" TP_POO_PHP/POO/TP/Offre/supprimerOffre/<?php echo $offre->getId(); ?>">Supprimer </a>
    </div>
</div>


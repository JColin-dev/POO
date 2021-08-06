<h1 class="liste">Liste des offres</h1>
<div class="offre">

    <?php

    foreach ($listeOffres as $offre) {

    ?>
        <div class="carte">
            <div class="card border-dark mb-3" style="max-width: 20rem;">
                <div class="card-header"><?php echo $offre->getTitre(); ?>, Publié par : <?php echo $offre->getUtilisateur()->getPseudo(); ?>
                    <?php if ($offre->getDomaine()->getDesignation()) { ?><span class="badge rounded-pill bg-info"><?php echo $offre->getDomaine()->getDesignation();
                                                                                                                } ?></span>
                        <?php
                        foreach ($offre->getListeCompetence() as $competence) { ?>

                            <span class="badge rounded-pill bg-primary"><?php echo $competence->getDesignation(); ?>
                            </span>
                        <?php
                        } ?>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo substr($offre->getDescription(), 0, 200); ?></p>
                </div>

                <a type="button" class="btn btn-primary" href="<?php echo Config::$baseUrl ?>/Offre/voirPlus/<?php echo $offre->getId(); ?>">Voir plus </a>
                <?php

                if (isset($_SESSION["utilisateur"])) {

                    $utilisateurConnecte = unserialize($_SESSION["utilisateur"]);
                    $idUtilisateuroffre = $offre->getUtilisateur()->getId();

                    if ($idUtilisateuroffre == $utilisateurConnecte->getId()) { ?>
                        <a type="button" class="btn btn-primary" href="<?php echo Config::$baseUrl ?>/Offre/modifierOffre/<?php echo $offre->getId(); ?>">Modifier </a>
                        <a type="button" class="btn btn-primary" href="<?php echo Config::$baseUrl ?>/Offre/supprimerOffre/<?php echo $offre->getId(); ?>">Supprimer </a>
                <?php }
                } ?>
            </div>
        </div>
    <?php
    }

    ?>
</div>
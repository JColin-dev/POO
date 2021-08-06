<h1 class="liste"><?php echo $modification ? "Modifier une offre" : "Insérer une offre" ?></h1>

<form class="form" action="<?php echo Config::$baseUrl ?>/offre/<?php echo $modification ? "modifierOffre/" . $id :  "insertionOffre" ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $modification ? $id : "" ?>" />
    <div class="form-group">
        <label class="col-form-label" for="inputDefault">titre</label>
        <input style="max-width:300px" type="text" class="form-control" name="titre" id="inputDefault" value="<?php echo $modification ? $offre->getTitre() : "" ?>">
    </div>

    <div class="form-group">
        <label for="exampleTextarea" class="form-label mt-4">Description</label>
        <textarea class="form-control" id="exampleTextarea" rows="3" name="description"><?php echo $modification ? substr($offre->getDescription(), 0, 200) : "" ?></textarea>
    </div>
    <?php if ($modification) { ?>
        <ul>
            <?php
            foreach ($listeCompetenceOffre as $competence) { ?>
                <li><?php echo $competence->getDesignation() ?><a type="button" class="btn btn-primary" href="<?php echo Config::$baseUrl ?>/offre/supprimerCompetence/<?php echo $id ?>/<?php echo $competence->getId(); ?>">Supprimer </a></li>


            <?php } ?>
        </ul>
    <?php } ?>
    <div class="form-group select">
        <select style="max-width:300px;" name="competence" class="form-select" id="exampleSelect1">
            <option value="">Sélectionner une compétence à ajouter</option>
            <?php

            foreach ($listeCompetence as $competence) {
            ?>
                <option value="<?= $competence->getId(); ?>"><?php echo $competence->getDesignation(); ?></option>

            <?php }

            ?>
        </select>
        <input style="margin-top:20px;" type="submit" class="btn btn-success" value="Ajouter" />
    </div>
    <input style="margin-top:20px;" type="submit" class="btn btn-success" value="Valider" />
</form>
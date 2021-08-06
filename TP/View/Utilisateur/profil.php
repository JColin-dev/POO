<div class="connect">

    <?php

    use View\ViewUtil;

    ViewUtil::ajouterChamps(
        $utilisateur->getPseudo(),
        "pseudo",
        "Pseudo",
        $erreurPseudo,
        "Votre Pseudo"
    ) ?>


    <h2>Compétences</h2>
    <?php
    foreach ($listeCompetenceUtilisateur as $competence) { ?>
        <div>
            <ul>
                <li><?php echo $competence->getDesignation(); ?>
                    <a type="button" class="btn btn-primary" href="<?php echo Config::$baseUrl ?>/Utilisateur/supprimerCompetence/<?php echo $competence->getId(); ?>">Supprimer </a>
                </li>
            </ul>
        </div>

    <?php
    }
    ?>

    <div class="form-group select">
        <select name="competence" class="form-select" id="exampleSelect1">
            <option value="">Sélectionner une compétence à ajouter</option>
            <?php
            foreach ($listeCompetenceNonAttribuee as $competence) { ?>
                <option value="<?= $competence->getId(); ?>"><?php echo $competence->getDesignation(); ?></option>
            <?php } ?>
        </select>
        <input style="margin-top:20px;" type="submit" class="btn btn-success" value="Ajouter" />
    </div>

    <?php 
    
    ViewUtil::ajouterChamps(
    "",
    "avatar",
    "Photo de profil",
    $erreurAvatar,
    "",
    "file"
    ) ?>

    <input style="margin-top:20px;" type="submit" class="btn btn-success" value="Modifier son profil" />

    </form>
</div>
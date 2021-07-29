<div class="connect">
    <form class="form" method="post">
        <div class="form-group">
            <label class="col-form-label" for="inputDefault">Pseudo</label>
            <input style="max-width:300px" value="<?php echo $utilisateur->getPseudo(); ?>" name="pseudo" type="text" class="form-control" placeholder="Pseudo" id="inputDefault">
        </div>
        <h2>Compétences</h2>
        <?php
        foreach ($listeCompetence as $competence) { ?>
            <div>
                <ul>
                    <li><?php echo $competence->getDesignation(); ?>
                        <a type="button" class="btn btn-primary" href="/TP_POO_PHP/POO/TP/Competence/deleteCompetence/<?php echo $competence->getId(); ?>">Supprimer </a>
                    </li>
                </ul>
            </div>

        <?php } ?>
        <input style="margin-top:20px;" type="submit" class="btn btn-success" value="Modifier son profil" />

    </form>
</div>
<?php

if (isset($_SESSION["utilisateur"])) {
    $utilisateur = unserialize($_SESSION["utilisateur"]);
?>


    <?php if ($utilisateur->getEntreprise()) {


    ?>
        <div class="para">
            <p>Bienvenue sur Paul Emploi</p>
            <p>Vous pouvez voir les offres et les modifier</p>
        </div>
    <?php } else { ?>
        <div class="para">
            <p>Bienvenue sur Paul Emploi</p>
            <p>Vous pouvez voir les offres</p>
        </div>
    <?php }
} else {

    ?>

    <div class="para">
        <p>Bienvenue sur Paul Emploi ! Besoin d'un job ?</p>
        <p>Connectez-vous pour les voir !</p>
    </div>
<?php }
?>
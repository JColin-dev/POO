<?php

foreach ($listeProduits as $produit) {

?>

    <form action="/Tests_POO_PHP/Recap/produit/modifierProduit" method="post">
        <label for="Prix">Prix : </label>
        <input type="number" name="prix" value="<?php echo $produit->getPrix(); ?> €">

        <label for="Name">Nom : </label>
        <input type="text" name="name" value="<?php echo $produit->getNom(); ?>">

        <label for="description">Description</label>
        <textarea name="description" id="" cols="30" rows="10"><?php echo $produit->getDescription(); ?></textarea>

    </form>

<?php
}

?>
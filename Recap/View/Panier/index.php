<ul>

    <?php

    foreach ($listeProduits as $produit) {

    ?>
        <div class="carte">
            <div class="card text-white bg-dark mb-3" style="max-width: 20rem;">
                <div class="card-header"><?php echo $produit->getPrix(); ?> €</div>
                <div class="card-body">
                    <h4 class="card-title"><?php echo $produit->getNom(); ?></h4>
                    <p class="card-text"><?php echo $produit->getDescription(); ?></p>
                </div>
                <button type="button" class="btn btn-info">Ajouter au panier</button>

            </div>
        </div>
    <?php
    }

    ?>

</ul>
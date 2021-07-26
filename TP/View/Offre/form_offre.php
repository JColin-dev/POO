<h1 class="liste"><?php echo $modification ? "Modifier une offre" : "Insérer une offre" ?></h1>

<form class="form" action="/TP_POO_PHP/POO/TP/offre/<?php echo $modification ? "modifierOffre" :  "insertionOffre" ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $modification ? $id : "" ?>" />
    <div class="form-group">
        <label class="col-form-label" for="inputDefault">titre</label>
        <input style="max-width:300px" type="text" class="form-control" name="titre" id="inputDefault" value="<?php echo $modification ?$offre->getTitre() : ""?>">
    </div>

    <div class="form-group">
        <label for="exampleTextarea" class="form-label mt-4">Description</label>
        <textarea class="form-control" id="exampleTextarea" rows="3" name="description"><?php echo $modification ? substr($offre->getDescription(), 0, 200): "" ?></textarea>
    </div>
    <input style="margin-top:20px;" type="submit" class="btn btn-success" value="Valider" />
</form>
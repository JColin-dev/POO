<h1 class="liste">Insérer une offre</h1>
<form class="form" action="/TP_POO_PHP/POO/TP/offre/insertionOffre" method="post">
    <div class="form-group">
        <label class="col-form-label" for="inputDefault">titre</label>
        <input style="max-width:300px" type="text" class="form-control" name="titre" id="inputDefault">
    </div>

    <div class="form-group">
        <label for="exampleTextarea" class="form-label mt-4">Description</label>
        <textarea class="form-control" id="exampleTextarea" rows="3" name="description"></textarea>
    </div>
    <input style="margin-top:20px;" type="submit" class="btn btn-success" value="Valider" />
</form>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <form id='form-crea-news' class="well"  action='index.php?controleur=news&action=ajouterNews' method='post' >     
                <span class="form-group">
                    <label for="titre"> Titre : </label>
                    <input type="text" name='titre' class="form-control"> 
                </span>
                <span class="form-group">
                    <label for="contenu">Contenu :</label>
                    <textarea name='contenu' placeholder="Entrer le contenu de la news" class="form-control" rows="12" ></textarea>   
                </span>
                <span class="form-group">
                    <input style="width: 100%;" class="btn btn-primary" type='submit' value='Ajouter la News' class="form-control" id='btn-ajout-news'>
                </span>
            </form>
        </div>
    </div>
</div>

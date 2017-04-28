<section>
    <div class="titre">
        Administration du site (Accès réservé)
    </div>

    <div class="container" style="margin-top: 13px;">
        <div class="row">
            <div class="col-lg-12">
                <form class="form-horizontal col-lg-12" method="post" action="index.php?controleur=connexion&action=seConnecter">
                    <div class="row">
                        <legend>Identification</legend>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            
                             <label class="col-lg-2" for="login"> Votre login : </label>
                             <div class="col-lg-10">
                                 <input class="form-control" type="text" name="login" id="login" />
                             </div>
                             
                            
                        </div>
                    </div>  
                    <div class="row">
                        <div class="form-group">
                            <label class="col-lg-2" for="passe"> Votre passe : </label> 
                            <div class="col-lg-10">
                                <input class="form-control" type="text" name="passe" id="passe" />
                            </div>
                            
                        </div>
                    </div>   
                    <div class="row">
                        <div class="form-group">
                            <label class="col-lg-2" for="connexion_auto" class="enligne"> Connexion automatique </label>
                            <div class="col-lg-10">
                                <input class="form-control" type ="checkbox" name="connexion_auto" id="connexion_auto" />  
                            </div>                                                
                        </div>
                    </div>   
                    <div class="row">
                        <div class="form-group">
                            <input class="form-control" type="submit" value="Connexion" />
                        </div>
                    </div>   









                </form>
            </div>        
        </div>
    </div>


</section>


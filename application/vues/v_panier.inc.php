<?php require_once chemins::LIBS . 'Panier.class.php'; ?>

<script>
    $(function(){ 
        
        $(".viderPanier").click(function(){
             $.ajax({ 
                 url : 'AJAX_script/viderPanier.php?<?php echo session_id() ?>', 
                 success : function(data){
                     $("article").html(data); 
                     console.log(data);
                 }
             });
        });
    });
</script>

<section class="panier">
    <div id="en-têtePanier">
        <img src="<?php echo Chemins::IMAGES . 'mon_panier.png' ?>"	alt="Panier" title="panier"/>
        <button class="viderPanier" >Vider le panier</button> 
    </div>
    <?php
    foreach (VariablesGlobales::$lesProduits as $unProduit) {
        $id = $unProduit->idProduit;
        $nom = $unProduit->LibelleProduit;
        $prix = $unProduit->PrixHTProduit;
        $categorie = $unProduit->idCategorie;
        $cheminImage = Chemins::IMAGES_PRODUITS . $unProduit->ImageProduit;
        ?>
        <article class="unProduit">
            <img src="<?php echo $cheminImage ?>" alt=image height="200" width="200" />
            <p>
                <?php
                echo $nom . " ($prix Euros)";
                ?>
            </p>
            <a href="index.php?controleur=panier&action=retirerProduit&produit=<?php echo $id ?>" onclick="return confirm('Voulez-vous vraiment retirer cet article ?');">
                <img src="<?php echo Chemins::IMAGES . 'retirer_panier.png' ?>" TITLE="Retirer du panier" ></a>


        </article>	
        <?php
    }
    ?>

    <a class="commander" href="#"><img src="<?php echo Chemins::IMAGES . 'je_commande.jpg' ?>" TITLE="Passer commande" ></a>
</section>


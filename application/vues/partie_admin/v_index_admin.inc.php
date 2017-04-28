<section style='padding-bottom: 25px;'>
    <div class="titre">
        Administration du site (Accès réservé) <br />
        - Bonjour <?php echo $_SESSION['pseudo']; ?> -
    </div>
    
    <div class="cat1">
        <a href="index.php?controleur=news&action=afficherRecapNews"><img src='<?php echo chemins::IMAGES . "martournal.png"; ?>' height="75" width="75">Gestion des news </a><br />       
    </div>
    <div class='cat2'>       
        <a href="index.php?controleur=connexion&action=seDeconnecter"><img src='<?php echo chemins::IMAGES . "logout.png"; ?>'  height="75" width="75" > Se déconnecter (<?php echo $_SESSION['pseudo']; ?>)</a>
    </div>
</section>
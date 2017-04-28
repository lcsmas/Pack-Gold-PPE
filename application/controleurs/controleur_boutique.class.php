<?php

class ControleurBoutique{
    public function __construct(){}
    
    public function afficher(){
        require_once chemins::MODELES . 'gestion_produit.class.php';
        VariablesGlobales::$lesCategories = GestionCategorie::getLesCategorie();
        if (isset($_REQUEST['categorie']))
        {           
            VariablesGlobales::$lesProduits = GestionProduit::getLesProduitsByCategorie(filter_input(INPUT_GET, 'categorie'));           
        }
            
        require_once chemins::VUES . 'v_boutique.inc.php';
    }    
}


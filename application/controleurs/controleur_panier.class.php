<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controleur_produit
 *
 * @author masl
 */
require_once chemins::LIBS . 'Panier.class.php';
require_once chemins::MODELES . 'gestion_produit.class.php';

class ControleurPanier {
    public function ajouter() {       
        $idProduit = filter_input(INPUT_GET, 'idProduit');
        $leProduit = GestionProduit::getLeProduit($idProduit);
        Panier::initialiser();
        Panier::ajouterProduit($leProduit);
        
        self::afficher(); 

    }
    
    public function afficher()
    {     
        VariablesGlobales::$lesProduits = Panier::getProduits();
        require_once chemins::VUES . 'v_panier.inc.php';
    }
    
    public function vider()
    {
        Panier::vider();
        self::afficher();
    }
    
    public function retirerProduit(){
        Panier::retirerProduit($_REQUEST['produit']);
        self::afficher();
    }
    
    public function getListeProduitPanier()
    {
        
    }
}

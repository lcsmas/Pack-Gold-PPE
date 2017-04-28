<?php

class GestionProduit extends GestionBDD{
    
    /**
     * Retourne la liste des produits
     * @return type Tableau d'objets
     */
    public static function getLesProduits() {
        return self::getLesTuples('produit');
    } 
    
    public static function getLesProduitsByCategorie($idCategorie){
        return self::getLesTuplesByChamp('produit', 'idCategorie',$idCategorie);
    }
    
    public static function getLeProduit($idProduit) {
        return self::getLeTupleByChamp('produit', 'idProduit', $idProduit);
    }
}

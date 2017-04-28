<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of gestion_utilisateur
 *
 * @author masl
 */
class GestionUtilisateur extends GestionBDD {
    
    public static function getUtilisateur($login, $passe){
        return parent::getLesTuplesByChamp('utilisateur', $login, $passe)[0];      
    }
}

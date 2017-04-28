<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controleur_admin
 *
 * @author masl
 */
class ControleurAdmin {
    public function __construct(){
        
    }   
    
    public function isAdmin(){
        if($_SESSION['isAdmin'] == 1){
            return true;
        }
        return false;
    }
    
    public function afficherIndex(){
        require_once chemins::VUES_ADMIN . 'v_index_admin.inc.php';
    }
}

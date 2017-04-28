<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controleur_connexion
 *
 * @author masl
 */
class ControleurConnexion {
    public function __construct() {
        
    }
    
    
    public function isConnected(){
        if(isset($_SESSION['idutilisateur'])){
            return true;
        }
        return false;
    }
    
    public function isConnexionDepuisFormulaire(){
        if(isset($_REQUEST['login']) && isset($_REQUEST['passe']))
            return true;
        return false;
    }
    
    public function seConnecter(){
        if(self::isConnected()){
            require_once chemins::CONTROLEURS . 'controleur_admin.class.php';
            $ControleurAdmin = new ControleurAdmin(); 
            if($ControleurAdmin->isAdmin()){
                $ControleurAdmin->afficherIndex();
            } else { 
                require_once chemins::VUES_ADMIN . 'v_acces_interdit.inc.php';
            }
        } elseif(self::isConnexionDepuisFormulaire()) {            
                require_once chemins::CONTROLEURS . "controleur_utilisateur.class.php";
                ControleurUtilisateur::verifUtilisateur($_REQUEST['login'], $_REQUEST['passe']);  
                if(self::isConnected()){
                    self::seConnecter();
                } else {
                    require_once chemins::VUES_ADMIN . "v_connexion.inc.php";
                }
                
        } else {
            require_once chemins::VUES_ADMIN . "v_connexion.inc.php";
        }       
    }
    
    public function seDeconnecter(){
        session_destroy();
        unset($_SESSION);
    }
}

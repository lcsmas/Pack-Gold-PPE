<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controleur_utilisateur
 *
 * @author masl
 */
class ControleurUtilisateur {
    public function __construct() {
        
    }
    
    public static function verifUtilisateur($login, $passe){
        require_once chemins::MODELES . 'gestion_utilisateur.class.php';
        $utilisateur = GestionUtilisateur::getUtilisateur(array("pseudo", "passe"), array($login, sha1($passe)));
        if($utilisateur != null){
            $_SESSION['idutilisateur'] = $utilisateur->idutilisateur;
            $_SESSION['pseudo'] = $utilisateur->pseudo;
            $_SESSION['isAdmin'] = $utilisateur->isAdmin;
            return true;
        }
        return false;
    }
}

<?php

session_start();
require_once 'configs/chemins.class.php';
require_once chemins::CONFIGS . 'variables_globales.class.php';
require_once chemins::CONFIGS . 'mysql_config.class.php';
require_once chemins::MODELES . 'gestion_bdd.class.php';
require_once chemins::MODELES . 'gestion_utilisateur.class.php';
require_once chemins::CONTROLEURS . 'controleur_connexion.class.php';
require_once chemins::LIBS . 'Panier.class.php';

//$cnx = new ControleurConnexion();
//if($cnx->isConnected()){
//    echo 'connecté';
//} else {
//    echo 'pas connecté';
//}
//
//echo '<br />';
//
//if(GestionUtilisateur::verifUtilisateur("admin", "bloch")){
//    echo 'utilisateur existe';
//} else {
//    echo "utilisateur n'existe pas";
//}

var_dump($_SESSION['produits']);
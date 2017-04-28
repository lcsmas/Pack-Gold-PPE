<?php

session_start();
require_once 'configs/chemins.class.php';
require_once chemins::CONFIGS . 'variables_globales.class.php';
require_once chemins::CONFIGS . 'mysql_config.class.php';
require_once chemins::MODELES . 'gestion_bdd.class.php';
require_once chemins::MODELES . 'gestion_news.class.php';
require_once chemins::MODELES . 'gestion_categorie.class.php';
require_once chemins::LIBS . 'Panier.class.php';
require_once chemins::VUES_PERMANENTES . 'v_entete.inc.php';

$controleur =           !isset($_REQUEST['controleur']) ? 'accueil' : $_REQUEST['controleur'];
$fichier_controleur =   'controleur_'.$controleur.'.class.php';
$classe_controleur =    'Controleur'.$controleur;
$action =               !isset($_REQUEST['action']) ? 'afficherLesNews' : $_REQUEST['action'];

require_once chemins::CONTROLEURS . $fichier_controleur;

$classe_controleur = new $classe_controleur();
$classe_controleur->$action();

require_once chemins::VUES_PERMANENTES . 'v_pied.inc.php';


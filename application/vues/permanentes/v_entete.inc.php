<!DOCTYPE html>
<html style="height:100%;">
    <head>
        <meta charset="utf-8" />
        
        <link rel="stylesheet" href="<?php echo chemins::BOOTSTRAP ?>css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo chemins::STYLES . 'style.css'; ?>" />
        <link href="<?php echo chemins::STYLES . 'styleform.css'; ?>" rel="stylesheet" type="text/css">
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <title>Site personnel de Lucas </title>
        <script type="text/javascript" src="<?php echo chemins::JS . 'jquery-1.3.2.min.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo chemins::JS . 'scrolltop.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo chemins::JS . 'jquery.oembed.js'; ?>"></script>
    </head>

    <!--[if IE 6 ]><body class="ie6 old_ie"><![endif]-->
    <!--[if IE 7 ]><body class="ie7 old_ie"><![endif]-->
    <!--[if IE 8 ]><body class="ie8"><![endif]-->
    <!--[if IE 9 ]><body class="ie9"><![endif]-->
    <!--[if !IE]><!--><!--<![endif]-->
    <body style="height:100%;">
        <div id="bloc_page2">
            <header>
                <div id="titre_principal">
                    <img src="<?php echo chemins::IMAGES . 'M.png'; ?>" alt="Logo de Zozor" id="logo" />
                    <h1>Boutique en ligne Lucas Mas</h1>

                </div>               
                <nav>
                    <ul>
                        <li><a class="btn btn-default" href="index.php?controleur=accueil&action=afficherLesNews">Accueil</a></li>
                        <li><a class="btn btn-default" href="index.php?controleur=boutique&action=afficher&categorie=1">Boutique</a></li>
                        <li>
                            <a class='button' href='index.php?controleur=panier&action=afficher'>
                                <img  src="<?php echo chemins::IMAGES . 'panier.png'; ?>" style="height: 52px; width: 52px" />
                                <span class="button_badge"><?php echo Panier::getNbProduits()?></span>
                            </a>
                        </li>
<!--                        <li><a class="btn btn-default" href="index.php?cas=lettre_motiv">Lettre de motivation</a></li>
                        <li><a class="btn btn-default" href="index.php?cas=cv">CV</a></li>
                        <li><a class="btn btn-default" href="index.php?cas=contact">Contact</a></li>
                        <li><a class="btn btn-default" href="index.php?cas=projet">Projet</a></li>-->
                    </ul>
                </nav>
            </header>

<!--            <div id="banniere_image">
                <div id="banniere_description">
                    Mon site préféré
                    <a href="https://openclassrooms.com/" class="bouton_rouge" target="blank">Accéder au site <img src="<?php echo chemins::IMAGES . 'flecheblanchedroite.png'; ?>" alt=""/></a>
                </div>
            </div>-->






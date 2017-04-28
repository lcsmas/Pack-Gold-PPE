-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 25 Avril 2017 à 12:27
-- Version du serveur :  5.5.44-0+deb8u1
-- Version de PHP :  5.6.27-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `masl1`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`masl`@`localhost` PROCEDURE `getClientById`(IN `id` VARCHAR(100))
    NO SQL
select *
from client
where idClient = id$$

CREATE DEFINER=`masl`@`localhost` PROCEDURE `getClientByNom`(IN `nom` VARCHAR(100))
    NO SQL
select * from client where NomClient LIKE concat(nom,"%")$$

CREATE DEFINER=`masl`@`localhost` PROCEDURE `insererClient`(IN `p_idClient` INT(11), IN `p_NomClient` VARCHAR(100), IN `p_PrenomClient` VARCHAR(45), IN `p_AdRueClient` VARCHAR(150), IN `p_AdCpClient` INT(11), IN `p_AdVilleClient` VARCHAR(100))
    NO SQL
INSERT INTO client values(p_idClient,p_NomClient,p_PrenomClient,p_AdRueClient,p_AdCpClient,p_AdVilleClient)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `idCategorie` int(11) NOT NULL,
  `LibelleCategorie` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `LibelleCategorie`) VALUES
(1, 'Ecran'),
(2, 'Souris'),
(3, 'Clavier'),
(4, 'Tapis de souris'),
(5, 'Goodies');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `idClient` int(11) NOT NULL,
  `NomClient` varchar(100) DEFAULT NULL,
  `PrenomClient` varchar(45) DEFAULT NULL,
  `AdRueClient` varchar(150) DEFAULT NULL,
  `AdCpClient` int(11) DEFAULT NULL,
  `AdVilleClient` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`idClient`, `NomClient`, `PrenomClient`, `AdRueClient`, `AdCpClient`, `AdVilleClient`) VALUES
(1, 'mas ', 'lucas', '10 rue du parc', 34420, 'villeneuve-lès-beziers'),
(2, 'LUANGPRASEUTH', 'alexis', 'lou de carriera', 34320, 'Valras');

--
-- Déclencheurs `client`
--
DELIMITER //
CREATE TRIGGER `casseUpdateClient` BEFORE UPDATE ON `client`
 FOR EACH ROW SET
NEW.NomClient = UPPER(NEW.NomClient),
NEW.PrenomClient = CONCAT( UPPER( LEFT(NEW.PrenomClient,1) ) , LOWER( SUBSTR( NEW.PrenomClient,2 ) ) )
//
DELIMITER ;
DELIMITER //
CREATE TRIGGER `nomCltInsert` BEFORE INSERT ON `client`
 FOR EACH ROW SET
NEW.NomClient = UPPER(NEW.NomClient),
NEW.PrenomClient = CONCAT(UPPER(LEFT(NEW.PrenomClient,1)),LOWER(SUBSTR(NEW.PrenomClient,2)))
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `idCommande` int(11) NOT NULL,
  `DateCommande` varchar(10) DEFAULT NULL,
  `idCli` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`idCommande`, `DateCommande`, `idCli`) VALUES
(1, 'retert', 1);

--
-- Déclencheurs `commande`
--
DELIMITER //
CREATE TRIGGER `verifAcquit` AFTER INSERT ON `commande`
 FOR EACH ROW BEGIN
    if((SELECT count(*) from commande where idCli=new.idCli and Acquitté=0)>0) THEN
    SIGNAL SQLSTATE '45001' SET MESSAGE_TEXT = "Le client n'a pas acquitté ses commandes précédentes";
    end if;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE IF NOT EXISTS `fournisseur` (
  `idFournisseur` int(11) NOT NULL,
  `NomFournisseur` varchar(100) DEFAULT NULL,
  `VilleFournisseur` varchar(100) DEFAULT NULL,
  `CPFournisseur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `lignedecommande`
--

CREATE TABLE IF NOT EXISTS `lignedecommande` (
  `idCommande` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `QuantiteCom` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `lignedecommande`
--

INSERT INTO `lignedecommande` (`idCommande`, `idProduit`, `QuantiteCom`) VALUES
(1, 1, 1);

--
-- Déclencheurs `lignedecommande`
--
DELIMITER //
CREATE TRIGGER `decrementQteStock` AFTER INSERT ON `lignedecommande`
 FOR EACH ROW UPDATE produit 
 set QteStockProduit = QteStockProduit - new.QuantiteCom 
 WHERE produit.idProduit = new.idProduit
//
DELIMITER ;
DELIMITER //
CREATE TRIGGER `verifQteStock` BEFORE INSERT ON `lignedecommande`
 FOR EACH ROW BEGIN	
	
    SET @qteP = (SELECT QteStockProduit from produit where idProduit = new.idProduit);
    
    IF( @qteP - new.QuantiteCom < 0 ) THEN
		set @msg = 'La quantitée commandée est supérieur à celle en stock';
        signal SQLSTATE '45000' set MESSAGE_TEXT = @msg;
	END IF;
   
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
`idnews` int(11) NOT NULL,
  `contenu` longtext NOT NULL,
  `titre` varchar(45) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `news`
--

INSERT INTO `news` (`idnews`, `contenu`, `titre`, `date`) VALUES
(1, '<p>Le but de ce site est de constituer un portfolio qui vous permettra de mieux connaitre qui je suis et quels sont \r\n            mes objectifs ainsi que de répertorier la plupart de mes productions tous domaines confondus.</p>\r\n        <p>Je suis actuellement étudiant en BTS SIO.</p> \r\n        <p>Je m''intéresse à de nombreux domaines de l''informatique en dehors de mes études et ne me bride pas à une seule spécialité,\r\n            je suis également passionné par l''ingénierie, qu''elle soit informatique, mécanique ou électronique. <br /><br /></p>\r\n\r\n        <p>Ici vous trouverez l''essentiel des documents me concernant en HTML ainsi qu''au format PDF téléchargeable :</p>\r\n        <ul>\r\n            <li><a href="lettre_motiv.html">Ma lettre de motivation</a></li>					\r\n            <li><a href="cv.html">Mon CV</a></li>\r\n        </ul>\r\n\r\n        <p>Vous pouvez également me contacter à l''aide d''un <a href="contact.html">formulaire</a></p>', 'Bienvenue sur mon site', '2016-04-13 14:53:00'),
(31, 'Si vous souhaitez accéder au différente fonction proposé par le panel d''administration, cliquer sur Administration dans le pied de page, vous y trouverez un tableau récapitulatif des news et vous pourrez supprimer plusieurs article en même temps.', 'Panel d''administration', '2016-05-13 12:10:33'),
(32, 'Supprimez moi svp', 'News à supprimer', '2016-05-13 12:11:37');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `idProduit` int(11) NOT NULL,
  `LibelleProduit` varchar(100) DEFAULT NULL,
  `PrixHTProduit` float DEFAULT NULL,
  `QteStockProduit` int(11) DEFAULT NULL,
  `idFournisseur` int(11) DEFAULT NULL,
  `idCategorie` int(11) DEFAULT NULL,
  `ImageProduit` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`idProduit`, `LibelleProduit`, `PrixHTProduit`, `QteStockProduit`, `idFournisseur`, `idCategorie`, `ImageProduit`) VALUES
(1, 'BenQ XL2411Z', 270, 2, NULL, 1, 'benq_xl2411z.jpg'),
(2, 'Zowie FK2', 70, 5, NULL, 2, 'zowie_fk2.jpg'),
(3, 'Steelseries 6Gv2', 80, 10, NULL, 3, 'steelseries_6Gv2.png'),
(4, 'Steelseries Qck Heavy', 35, 20, NULL, 4, 'qck_heavy.jpg'),
(5, 'Bracelet MyFriend - MyBrother', 4, 30, NULL, 5, 'myfriend_bracelet.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idutilisateur` int(11) NOT NULL,
  `pseudo` varchar(45) NOT NULL,
  `passe` varchar(45) NOT NULL,
  `isAdmin` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idutilisateur`, `pseudo`, `passe`, `isAdmin`) VALUES
(1, 'admin', '976ecb2e6d0deea28fee06b1f9b763b0e81ac4b8', 1),
(2, 'random', '976ecb2e6d0deea28fee06b1f9b763b0e81ac4b8', 0),
(3, 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
 ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
 ADD PRIMARY KEY (`idClient`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
 ADD PRIMARY KEY (`idCommande`), ADD KEY `FKCli` (`idCli`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
 ADD PRIMARY KEY (`idFournisseur`);

--
-- Index pour la table `lignedecommande`
--
ALTER TABLE `lignedecommande`
 ADD PRIMARY KEY (`idCommande`,`idProduit`), ADD KEY `FKCom` (`idCommande`), ADD KEY `FKProd` (`idProduit`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`idnews`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
 ADD PRIMARY KEY (`idProduit`), ADD KEY `FKFourn` (`idFournisseur`), ADD KEY `FKCat` (`idCategorie`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
 ADD PRIMARY KEY (`idutilisateur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
MODIFY `idnews` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
ADD CONSTRAINT `FKCli` FOREIGN KEY (`idCli`) REFERENCES `client` (`idClient`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `lignedecommande`
--
ALTER TABLE `lignedecommande`
ADD CONSTRAINT `FKCom` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`idCommande`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `FKProd` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`idProduit`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
ADD CONSTRAINT `fk_produit_categorie` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`),
ADD CONSTRAINT `fk_produit_fournisseur` FOREIGN KEY (`idFournisseur`) REFERENCES `fournisseur` (`idFournisseur`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

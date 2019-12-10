-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 10 déc. 2019 à 21:34
-- Version du serveur :  5.5.47-0+deb8u1
-- Version de PHP :  7.2.22-1+0~20190902.26+debian8~1.gbpd64eb7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gleizest`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`gleizest`@`%` PROCEDURE `GenereCodeConfirmation` (IN `p_mail` VARCHAR(60))  NO SQL
    DETERMINISTIC
BEGIN
	DECLARE r int(5);
    DECLARE test int(1);


    SET test = 0;

    WHILE test = 0 DO
    	SELECT ROUND( RAND() * 9999 ) INTO r;
        IF r > 1000 THEN
        	SELECT COUNT(idClient) INTO test
            FROM Clients
            WHERE codeConfirmation = r;
            IF test = 0 THEN
            	SET test = 1;
            END IF;
        END IF;
	END WHILE;

	UPDATE Clients
    SET codeConfirmation = r
    WHERE Email = p_mail;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `Alimentation`
--

CREATE TABLE `Alimentation` (
  `refAlim` int(11) NOT NULL,
  `puissance` int(20) NOT NULL,
  `modularite` varchar(20) NOT NULL,
  `refProduit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Alimentation`
--

INSERT INTO `Alimentation` (`refAlim`, `puissance`, `modularite`, `refProduit`) VALUES
(5, 750, 'semi-modulaire', 23),
(6, 700, 'Semi-modulaire', 13),
(7, 450, 'Non modulaire', 37),
(8, 1600, 'Modulaire', 38),
(9, 450, 'Non modulaire', 39);

-- --------------------------------------------------------

--
-- Structure de la table `Avis`
--

CREATE TABLE `Avis` (
  `idClient` int(11) NOT NULL,
  `refProduit` int(11) NOT NULL,
  `note` float NOT NULL,
  `commentaire` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Avis`
--

INSERT INTO `Avis` (`idClient`, `refProduit`, `note`, `commentaire`, `date`) VALUES
(1, 1, 4, 'c\'est cool', '2019-12-10'),
(1, 3, 0, 'AAA', '2019-12-06'),
(1, 7, 2, 'Stylé', '2019-12-07'),
(1, 8, 0, 'rthreht', '2019-12-07'),
(1, 15, 0, '<h5> 555 </h5>', '2019-12-08'),
(1, 18, 0, 'Radeon c\'est pas ouf.', '2019-12-05'),
(1, 27, 0, 'SALUT', '2019-12-07'),
(1, 35, 1.5, 'ça coûte très cher pour une carte mère !', '2019-12-05'),
(1, 53, 0, 'RADEON', '2019-12-06'),
(79, 1, 2.5, 'Pourrie fait tourner LOL a seulement 200 FPS ', '2019-10-11'),
(82, 3, 5, '1000 étoiles', '2019-12-05'),
(82, 16, 0, '\"select * from client;--', '2019-12-05'),
(87, 2, 5, 'Trop trop bien minecraft marche a 5 fps avec ça!', '2019-12-10'),
(87, 6, 3, 'Produit correcte!!', '2019-12-10'),
(87, 10, 4.5, 'trop trop bien ', '2019-12-10'),
(88, 9, 4, '-9999999999IIIII', '2019-12-07'),
(88, 52, 0, '<h5> cool </h5>', '2019-12-08'),
(93, 1, 0, 'C\'est cool', '2019-12-10'),
(93, 2, 0, 'ssss', '2019-12-10');

-- --------------------------------------------------------

--
-- Structure de la table `CarteGraphique`
--

CREATE TABLE `CarteGraphique` (
  `refCG` int(11) NOT NULL,
  `chipset` varchar(20) NOT NULL,
  `memoire` int(5) NOT NULL,
  `architecture` varchar(20) NOT NULL DEFAULT 'champ non renseigné',
  `bus` varchar(20) NOT NULL,
  `refProduit` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `CarteGraphique`
--

INSERT INTO `CarteGraphique` (`refCG`, `chipset`, `memoire`, `architecture`, `bus`, `refProduit`) VALUES
(7, 'RTX 2080 Ti', 11, 'Turing', 'PCI Express 3.0', 8),
(8, 'RX 580', 8, 'Polaris', 'PCI Express 3.0', 18),
(9, 'RTX 2080 Ti', 11, 'Turing', 'PCI Express 3.0', 25),
(10, 'GT 710', 1, 'NULL\r\n', 'PCI Express 2.0', 26),
(11, 'GTX 1650', 4, 'Turing', 'PCI Express 3.0', 27),
(12, 'RTX 2080 SUPER', 8, 'Turing', 'PCI Express 3.0', 49),
(13, 'RTX 2080 Ti', 11, 'Turing', 'PCI Express 3.0', 50),
(14, 'RTX 2080 Ti', 11, 'Turing', 'PCI Express 3.0', 51),
(15, 'RTX 2080 Ti', 11, 'Turing', 'PCI Express 3.0', 52),
(16, 'Radeon RX 5700 XT', 8, 'Navis', 'PCI Express 4.0', 53),
(17, ' NVIDIA TITAN RTX', 24, ' Turing', 'PCI Express 3.0', 2);

-- --------------------------------------------------------

--
-- Structure de la table `CarteMere`
--

CREATE TABLE `CarteMere` (
  `refCM` int(11) NOT NULL,
  `chipset` varchar(20) NOT NULL,
  `socket` varchar(20) NOT NULL,
  `format` varchar(20) NOT NULL,
  `refProduit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `CarteMere`
--

INSERT INTO `CarteMere` (`refCM`, `chipset`, `socket`, `format`, `refProduit`) VALUES
(1, 'Intel® X299', '2066', 'E-ATX', 3),
(5, 'Intel® Z390', 'LGA 1151', 'ATX', 16),
(6, 'AMD® TRX40', 'TRX4', 'E-ATX', 32),
(7, 'AMD® TRX40', 'TRX4', 'ATX', 33),
(8, 'AMD X570', 'AM4', 'ATX', 34),
(9, 'Intel® X299', '2066', 'XL-ATX', 35),
(10, 'Intel® Z390', '1151', 'ATX', 36);

-- --------------------------------------------------------

--
-- Structure de la table `Clients`
--

CREATE TABLE `Clients` (
  `idClient` int(5) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `nomClient` varchar(20) NOT NULL,
  `prenomClient` varchar(20) NOT NULL,
  `villeClient` varchar(20) NOT NULL,
  `adresseClient` varchar(40) NOT NULL,
  `nbProduitPanier` int(10) NOT NULL DEFAULT '0',
  `montantPanier` int(10) NOT NULL DEFAULT '0',
  `prioriter` int(5) NOT NULL DEFAULT '0' COMMENT '0 : client / 1 : Admin',
  `mdp` varchar(64) NOT NULL,
  `codeConfirmation` int(5) NOT NULL COMMENT '0 : confirmer',
  `token` varchar(64) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Clients`
--

INSERT INTO `Clients` (`idClient`, `Email`, `nomClient`, `prenomClient`, `villeClient`, `adresseClient`, `nbProduitPanier`, `montantPanier`, `prioriter`, `mdp`, `codeConfirmation`, `token`) VALUES
(1, 'pyheffappilla-5656@yopmail.com', 'Gleizes', 'Thomas', 'SoftCity', '123 rue du Hardware', 5, 2816, 1, '96f824ba8d74669d6c98e995cbae8561e212bdeb1d8c55cec9289636c9449592', 0, '0'),
(2, 'test@gmail.com', 'Savouret', 'Basile', 'Montpellier', '354 rue Maurice et Katia Kraft', 0, 0, 1, 'ca59e81db6c1e76b22441f52d88189eb618b02afaecba10ffa9cbcae8b64d4e6', 0, '0'),
(79, 'socialempire971@hotmail.fr', 'Viator', 'Davio', 'Montpellier', '1101 avenue agropolis', 10, 43675, 1, '8fe6fdf88faad74a7000423b5e1dd217f0cf29a0092b9d03cd1d48e2cd3f3929', 0, '0'),
(80, 'ijissaxec-4098@yopmail.com', 'gleizes', 'Thomas', 'fabregues', '457 chemin des coureches', 0, 0, 0, '96f824ba8d74669d6c98e995cbae8561e212bdeb1d8c55cec9289636c9449592', 0, '0'),
(81, 'KALAT@gmail.com', 'gleizes', 'Thomas', 'fabregues', '457 chemin des coureches', 0, 0, 0, '1da570e2dd5cfb984ad6de680732da77e5f071d409d30d14d0cc5f68272f96b8', 0, '0'),
(82, 'emaildebonsoir@yopmail.com', 'bonsoir', 'bonsoir', 'bonsoir', 'bonsoir', 1, 1035, 0, '260f1eb4ac24588bd3b96db543e41697ddd5ea9d4fe56af4aa9f799da9d6302f', 0, '0'),
(83, 'Ange.Clement@gmail.com', 'Ange', 'Clement', 'Montpelleier', '458 rue de l\'avenue', 0, 0, 0, '7e25cc37b288e4f4ffff44909fa431b05fbc03d445139ead8e732e6c300b2ea6', 0, '0'),
(85, 'emaildebonsoir2@yopmail.com', 'Ange', 'Clément', 'Mont', 'Avenye', 0, 0, 0, '7e25cc37b288e4f4ffff44909fa431b05fbc03d445139ead8e732e6c300b2ea6', 0, '0'),
(86, 'emaildebonsoir3@yopmail.com', 'JGHF', 'COYC', 'njkf', 'hdhf', 0, 0, 0, 'da18af0a6e33ed34a59da4050154801f90180223e9afae5093cca84fe6fe6465', 0, '0'),
(87, 'savouret.basile@gmail.com', 'Savouret', 'Basile', 'Montpellier', '354 rue Maurice et Katia Kraft', 3, 2820, 1, 'ca59e81db6c1e76b22441f52d88189eb618b02afaecba10ffa9cbcae8b64d4e6', 0, '0'),
(88, 'zilver@yopmail.com', 'gleizes', 'Thomas', 'fabregues', '457 chemin des coureches', 1, 80, 0, 'df03b3adc8e04a0e94967f5852456e0c7a72903724ddf3579a248e036f1bb67f', 0, '0'),
(89, 'eduzylluf-3548@yopmail.com', 'test', 'testMdp', 'Montpellier', '354 rue Maurice et Katia Kraft', 0, 0, 0, 'e7cc2d8629edfca1a6f43461ff1e272fad5128cab7cdfc280484aaec3e1ae6f6', 0, '0'),
(90, 'kalat@yopmail.com', 'latak', 'kalat', 'fabregues', '457 chemin des coureches', 1, 5940, 0, 'a8108248e3b13f5b7604b0f4a386ac334bd0bd745ebf053afc56755f210fcdd2', 0, '0'),
(93, 'thomasgleizes34@gmail.com', 'gleizes', 'Kalat', 'fabregues', '457 chemin des coureches', 0, 0, 0, 'adaeba8ad960ee2c0a855bb9806f85b91cc36aa8a5a20fc836bffd2b7f0a8364', 0, '0');

-- --------------------------------------------------------

--
-- Structure de la table `Commandes`
--

CREATE TABLE `Commandes` (
  `idCommande` int(11) NOT NULL,
  `dateCommande` date NOT NULL,
  `idClient` int(5) NOT NULL,
  `nbProduit` int(11) NOT NULL DEFAULT '0',
  `montantCommande` int(11) NOT NULL DEFAULT '0',
  `etatCommande` varchar(20) NOT NULL DEFAULT 'En attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Commandes`
--

INSERT INTO `Commandes` (`idCommande`, `dateCommande`, `idClient`, `nbProduit`, `montantCommande`, `etatCommande`) VALUES
(1, '2019-11-21', 1, 7, 8034, 'Livré'),
(2, '2019-12-01', 1, 6, 4291, 'En attente'),
(28, '2019-12-07', 1, 2, 3570, 'En attente'),
(29, '2019-12-07', 88, 1, 402, 'En attente'),
(35, '2019-12-07', 88, 1, 520, 'En attente'),
(36, '2019-12-08', 88, 1, 2700, 'En attente'),
(37, '2019-12-09', 1, 4, 935, 'En attente'),
(39, '2019-12-09', 88, 4, 4560, 'En attente'),
(44, '2019-12-09', 1, 1, 40, 'En attente');

-- --------------------------------------------------------

--
-- Structure de la table `DisqueDur`
--

CREATE TABLE `DisqueDur` (
  `refHDD` int(11) NOT NULL,
  `capacite` int(20) NOT NULL,
  `interface` varchar(20) NOT NULL,
  `vitesseRotation` int(20) NOT NULL,
  `refProduit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `DisqueDur`
--

INSERT INTO `DisqueDur` (`refHDD`, `capacite`, `interface`, `vitesseRotation`, `refProduit`) VALUES
(1, 4000, 'SATA III', 5400, 4),
(3, 1000, 'SATA III - 6.0 Gbps', 7200, 14),
(5, 4000, 'SATA III', 7200, 46),
(6, 2000, 'SATA III', 5400, 55);

-- --------------------------------------------------------

--
-- Structure de la table `ListeCommander`
--

CREATE TABLE `ListeCommander` (
  `idCommande` int(5) NOT NULL,
  `refProduit` int(20) NOT NULL,
  `quantiteProduit` int(5) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ListeCommander`
--

INSERT INTO `ListeCommander` (`idCommande`, `refProduit`, `quantiteProduit`) VALUES
(1, 4, 1),
(1, 24, 1),
(1, 25, 1),
(1, 28, 1),
(1, 35, 1),
(1, 38, 1),
(1, 40, 1),
(2, 4, 1),
(2, 13, 1),
(2, 32, 1),
(2, 43, 1),
(2, 44, 1),
(28, 50, 2),
(29, 53, 1),
(35, 3, 1),
(37, 1, 1),
(37, 4, 2),
(37, 27, 1),
(39, 16, 1),
(39, 20, 1),
(39, 28, 2),
(44, 26, 1);

--
-- Déclencheurs `ListeCommander`
--
DELIMITER $$
CREATE TRIGGER `IncreCommande` AFTER INSERT ON `ListeCommander` FOR EACH ROW BEGIN
	DECLARE vprix int(11);

	SELECT prix INTO vprix
	FROM Produits
	WHERE refProduit = NEW.refProduit;

	UPDATE Commandes
	SET montantCommande = montantCommande + vprix * NEW.quantiteProduit, nbProduit = nbProduit + NEW.quantiteProduit
	WHERE idCommande = NEW.idCommande;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UpdateCommande` AFTER UPDATE ON `ListeCommander` FOR EACH ROW BEGIN
	DECLARE vprix int(15);

    SELECT prix INTO vprix
    FROM Produits
	WHERE refProduit = NEW.refProduit;

    UPDATE Commandes
    SET montantCommande = montantCommande + vprix * NEW.quantiteProduit, nbProduit = nbproduit + NEW.quantiteProduit
    WHERE idCommande = NEW.idCommande;

    UPDATE Commandes
	SET montantCommande = montantCommande - vprix * OLD.quantiteProduit, nbProduit = nbProduit - OLD.quantiteProduit
	WHERE idCommande = OLD.idCommande;


END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UpdateStock` BEFORE UPDATE ON `ListeCommander` FOR EACH ROW BEGIN
	DECLARE vStock int (10);

	SELECT stock INTO vStock
	FROM Produits
	WHERE refProduit = NEW.refProduit;

	IF (vStock < NEW.quantiteProduit) THEN
		SIGNAL SQLSTATE '20001'
    	SET MESSAGE_TEXT = 'Stock dépasser';
	ELSE
		UPDATE Produits
		SET stock = stock - NEW.quantiteProduit
		WHERE refProduit = NEW.refProduit;

		UPDATE Produits
		SET stock = stock + OLD.quantiteProduit
		WHERE refProduit = OLD.refProduit;
	END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delCommande` AFTER DELETE ON `ListeCommander` FOR EACH ROW BEGIN
	DECLARE
	vprix int(11);

	SELECT prix INTO vprix
	FROM Produits
	WHERE refProduit = OLD.refProduit;

	UPDATE Commandes
	SET montantCommande = montantCommande - vprix * OLD.quantiteProduit, nbProduit = nbProduit - OLD.quantiteProduit
	WHERE idCommande = OLD.idCommande;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delStock` BEFORE DELETE ON `ListeCommander` FOR EACH ROW BEGIN
	UPDATE Produits
	SET stock = stock + OLD.quantiteProduit
	WHERE refProduit = OLD.refProduit;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `increStock` BEFORE INSERT ON `ListeCommander` FOR EACH ROW BEGIN
	DECLARE vStock int (10);

	SELECT stock INTO vStock
	FROM Produits
	WHERE refProduit = NEW.refProduit;

	IF (vStock < NEW.quantiteProduit) THEN
		SIGNAL SQLSTATE '20001'
    	SET MESSAGE_TEXT = 'Stock dépasser';
	ELSE
		UPDATE Produits
		SET stock = stock - NEW.quantiteProduit
		WHERE refProduit = NEW.refProduit;
	END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `Memoire`
--

CREATE TABLE `Memoire` (
  `refRAM` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `capacite` int(20) NOT NULL,
  `frequence` int(20) NOT NULL,
  `CAS` int(20) NOT NULL,
  `nbBarrette` int(20) NOT NULL,
  `refProduit` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Memoire`
--

INSERT INTO `Memoire` (`refRAM`, `type`, `capacite`, `frequence`, `CAS`, `nbBarrette`, `refProduit`) VALUES
(1, 'DDR4', 16, 3200, 16, 2, 5),
(6, 'DDR3', 8, 1600, 10, 1, 19),
(7, 'DDR4', 128, 2933, 14, 8, 28),
(8, 'DDR4', 64, 3600, 16, 4, 29),
(9, 'DDR4', 16, 4600, 18, 2, 30),
(10, 'DDR4', 32, 3200, 16, 4, 31);

-- --------------------------------------------------------

--
-- Structure de la table `Panier`
--

CREATE TABLE `Panier` (
  `idClient` int(10) NOT NULL,
  `refProduit` int(10) NOT NULL,
  `quantiteProduit` int(5) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Panier`
--

INSERT INTO `Panier` (`idClient`, `refProduit`, `quantiteProduit`) VALUES
(1, 10, 1),
(1, 23, 1),
(1, 30, 1),
(1, 41, 1),
(1, 51, 1),
(79, 2, 4),
(79, 7, 3),
(79, 24, 1),
(79, 32, 2),
(79, 42, 3),
(79, 48, 5),
(79, 51, 4),
(79, 52, 7),
(79, 53, 3),
(82, 31, 3),
(87, 1, 1),
(87, 3, 4),
(87, 4, 2),
(88, 26, 2),
(90, 1, 11);

--
-- Déclencheurs `Panier`
--
DELIMITER $$
CREATE TRIGGER `DeincrePanierClient` AFTER DELETE ON `Panier` FOR EACH ROW BEGIN
	DECLARE vprix int(11);

	SELECT prix INTO vprix
	FROM Produits
	WHERE refProduit = OLD.refProduit;

	UPDATE Clients
	SET montantPanier = montantPanier - (vprix * OLD.quantiteProduit), nbProduitPanier = nbProduitPanier - 1
	WHERE idClient = OLD.idClient;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UpdatePanierClient` AFTER UPDATE ON `Panier` FOR EACH ROW BEGIN
	DECLARE vprix int(15);

	SELECT prix INTO vprix
	FROM Produits
	WHERE refProduit = NEW.refProduit;

	UPDATE Clients
	SET montantPanier = montantPanier + (vprix * NEW.quantiteProduit), nbProduitPanier = nbProduitPanier + 1
	WHERE idClient = NEW.idClient;

    SELECT prix INTO vprix
	FROM Produits
	WHERE refProduit = OLD.refProduit;

	UPDATE Clients
	SET montantPanier = montantPanier - (vprix * OLD.quantiteProduit), nbProduitPanier = nbProduitPanier - 1
	WHERE idClient = OLD.idClient;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `increPanierClient` AFTER INSERT ON `Panier` FOR EACH ROW BEGIN
	DECLARE vprix int(11);

	SELECT prix INTO vprix
	FROM Produits
	WHERE refProduit = NEW.refProduit;

	UPDATE Clients
	SET montantPanier = montantPanier + (vprix * NEW.quantiteProduit), nbProduitPanier = nbProduitPanier + 1
	WHERE idClient = NEW.idClient;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `Processeur`
--

CREATE TABLE `Processeur` (
  `refCPU` int(11) NOT NULL,
  `nbCoeur` int(5) NOT NULL,
  `nbThreads` int(5) NOT NULL,
  `socket` varchar(20) NOT NULL,
  `frequence` float NOT NULL,
  `boost` float NOT NULL,
  `cache` int(10) NOT NULL,
  `refProduit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Processeur`
--

INSERT INTO `Processeur` (`refCPU`, `nbCoeur`, `nbThreads`, `socket`, `frequence`, `boost`, `cache`, `refProduit`) VALUES
(1, 32, 64, 'TRX40', 3.7, 4.5, 144, 6),
(2, 8, 16, 'LGA 1', 4, 5, 16, 9),
(3, 6, 6, 'LGA 1', 3.7, 4.6, 9, 10),
(5, 4, 4, 'LGA 1', 3.6, 4.2, 6, 11),
(6, 6, 12, 'AM4', 3.6, 4.2, 36, 17),
(9, 6, 12, '2011-3', 3.5, 3.7, 15, 20),
(10, 8, 16, 'AM4', 3.6, 4.4, 36, 21),
(11, 4, 4, 'AM4', 3.5, 3.7, 4, 22),
(12, 8, 16, 'LGA 1151', 3.6, 5, 16, 1),
(13, 24, 48, 'TR40X', 3.8, 4.5, 140, 24),
(15, 10, 20, '2066', 3.3, 4.5, 16, 48),
(16, 8, 8, 'LGA 1151', 3.6, 4.9, 12, 56);

-- --------------------------------------------------------

--
-- Structure de la table `Produits`
--

CREATE TABLE `Produits` (
  `refProduit` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `nomMarque` varchar(20) NOT NULL,
  `categorie` varchar(20) NOT NULL,
  `prix` int(10) NOT NULL,
  `stock` int(10) NOT NULL,
  `Url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Produits`
--

INSERT INTO `Produits` (`refProduit`, `nom`, `nomMarque`, `categorie`, `prix`, `stock`, `Url`) VALUES
(1, 'Intel Core i9-9900K (3.6 GHz)', 'Intel', 'Processeur', 540, 15, 'https://www.topachat.com/boutique/img/in/in1011/in10114555/in1011455502@2x.jpg'),
(2, 'Nvidia TITAN RTX, 24 Go', 'Nvidia', 'CarteGraphique', 2700, 13, 'https://www.topachat.com/boutique/img/in/in1011/in10117193/in1011719302@2x.jpg'),
(3, 'Gigabyte X299X AORUS MASTER', 'Gigabyte', 'CarteMere', 520, 4, 'https://www.topachat.com/boutique/img/in/in1101/in11019804/in1101980402@2x.jpg'),
(4, 'Seagate BarraCuda 4 To', 'Seagate', 'DisqueDur', 100, 7, 'https://www.topachat.com/boutique/img/in/in1010/in10106812/in1010681202@2x.jpg'),
(5, 'DDR4 Corsair Vengeance RGB PRO, Noir, 16 Go (2 x 8 Go)', 'Corsair', 'Memoire', 100, 12, 'https://www.topachat.com/boutique/img/in/in1011/in10112576/in1011257602@2x.jpg'),
(6, 'AMD Ryzen Threadripper 3970X (3.7 GHz)', 'AMD', 'Processeur', 2350, 3, 'https://www.topachat.com/boutique/img/in/in1101/in11019635/in1101963502@2x.jpg'),
(7, 'PNY CS3030, 500 Go, M.2', 'PNY', 'SSD', 80, 14, 'https://www.topachat.com/boutique/img/in/in1011/in10118184/in1011818402.jpg'),
(8, 'EVGA GeForce RTX 2080 Ti FTW3 ULTRA GAMING, 11 Go', 'EVGA', 'CarteGraphique', 1500, 6, 'https://www.topachat.com/boutique/img/in/in1011/in10114249/in1011424902@2x.jpg'),
(9, 'Intel Core i9-9900KS (4.0 GHz)', 'Intel', 'Processeur', 640, 6, 'https://www.topachat.com/boutique/img/in/in1101/in11019445/in1101944502@2x.jpg'),
(10, 'Intel Core i5-9600KF (3.7 GHz)', 'Intel', 'Processeur', 200, 9, 'https://www.topachat.com/boutique/img/in/in1011/in10116767/in1011676702.jpg'),
(11, 'Intel Core i3-9100F (3.6 GHz)', 'Intel', 'Processeur', 80, 12, 'https://www.topachat.com/boutique/img/in/in1011/in10119328/in1011932802@2x.jpg'),
(12, 'DDR4 HyperX Fury, 16 Go (2 x 8 Go), 2666 MHz, CAS 16', 'HyperX', 'Memoire', 84, 9, 'https://www.topachat.com/boutique/img/in/in1101/in11018183/in1101818302@2x.jpg'),
(13, 'Gigabyte B700H, 700W', 'Gigabyte', 'Alimentation', 60, 16, 'https://www.topachat.com/boutique/img/in/in1011/in10114060/in1011406002@2x.jpg'),
(14, 'Western Digital WD Blue, 1 To', 'WesternDigital', 'DisqueDur', 45, 12, 'https://www.topachat.com/boutique/img/in/in1006/in10063338/in1006333802@2x.jpg'),
(15, 'Crucial BX500, 240 Go, SATA III', 'Crucial', 'SSD', 35, 12, 'https://www.topachat.com/boutique/img/in/in1011/in10113696/in1011369602@2x.jpg'),
(16, 'MSI MEG Z390 GODLIKE', 'MSI', 'CarteMere', 560, 5, 'https://www.topachat.com/boutique/img/in/in1011/in10114439/in1011443902@2x.jpg'),
(17, 'AMD Ryzen 5 3600 (3.6 GHz)', 'AMD', 'Processeur', 225, 18, 'https://www.topachat.com/boutique/img/in/in1101/in11016970/in1101697002@2x.jpg'),
(18, 'MSI Radeon RX 580 ARMOR 8G OC, 8 Go', 'MSI', 'CarteGraphique', 160, 4, 'https://www.topachat.com/boutique/img/in/in1010/in10104224/in1010422402@2x.jpg'),
(19, 'DDR3 HyperX Fury Red, 8 Go, 1600 MHz, CAS 10', 'HyperX', 'Memoire', 45, 12, 'https://www.topachat.com/boutique/img/in/in1007/in10078056/in1007805602.jpg'),
(20, 'Intel Core i7-5930K (3.5 GHz)', 'Intel', 'Processeur', 560, 14, 'https://www.topachat.com/boutique/img/in/in1008/in10080849/in1008084902@2x.jpg'),
(21, 'AMD Ryzen 7 3700X (3.6 GHz)', 'AMD', 'Processeur', 360, 9, 'https://www.topachat.com/boutique/img/in/in1101/in11016968/in1101696802@2x.jpg'),
(22, 'AMD Ryzen 3 2200G (3.5 GHz)', 'AMD', 'Processeur', 95, 25, 'https://www.topachat.com/boutique/img/in/in1011/in10110199/in1011019902@2x.jpg'),
(23, 'EVGA 750 GQ, 750W', 'EVGA', 'Alimentation', 110, 6, 'https://www.topachat.com/boutique/img/in/in1009/in10095728/in1009572802@2x.jpg'),
(24, 'AMD Ryzen Threadripper 3960X (3.8 GHz)', 'AMD', 'Processeur', 1535, 1, 'https://www.topachat.com/boutique/img/in/in1101/in11019634/in1101963402@2x.jpg'),
(25, 'Asus GeForce RTX 2080 Ti ROG STRIX OC, 11 Go', 'Asus', 'CarteGraphique', 1400, 24, 'https://www.topachat.com/boutique/img/in/in1011/in10115045/in1011504502@2x.jpg'),
(26, 'MSI GeForce GT 710 1GD3H LP, 1 Go', 'MSI', 'CarteGraphique', 40, 1, 'https://www.topachat.com/boutique/img/in/in1009/in10095284/in1009528402@2x.jpg'),
(27, 'MSI GeForce GTX 1650 GAMING X, 4 Go', 'MSI', 'CarteGraphique', 195, 0, 'https://www.topachat.com/boutique/img/in/in1011/in10118792/in1011879202@2x.jpg'),
(28, 'DDR4 G.Skill Trident Z RGB, 128 Go (8 x 16 Go), 2933 MHz, CAS 14', 'G.Skill', 'Memoire', 1720, 6, 'https://www.topachat.com/boutique/img/in/in1011/in10116098/in1011609802@2x.jpg'),
(29, 'DDR4 G.Skill Trident Z Neo, 64 Go (4 x 16 Go), 3600 MHz, CAS 16', 'G.Skill', 'Memoire', 730, 3, 'https://www.topachat.com/boutique/img/in/in1101/in11017740/in1101774002@2x.jpg'),
(30, 'DDR4 G.Skill Trident Z Royal Argent, 16 Go (2 x 8 Go), 4600 MHz, CAS 18', 'G.Skill', 'Memoire', 470, 6, 'https://www.topachat.com/boutique/img/in/in1011/in10116311/in1011631102@2x.jpg'),
(31, 'DDR4 Corsair Dominator Platinum RGB, 32 Go (4 x 8 Go), 3200 MHz, CAS 16', 'Corsair', 'Memoire', 345, 3, 'https://www.topachat.com/boutique/img/in/in1011/in10117327/in1011732702@2x.jpg'),
(32, 'ASUS ROG ZENITH II EXTREME', 'Asus', 'CarteMere', 836, 3, 'https://www.topachat.com/boutique/img/in/in1101/in11019763/in1101976302@2x.jpg'),
(33, 'Asus PRIME TRX40-PRO', 'Asus', 'CarteMere', 465, 1, 'https://www.topachat.com/boutique/img/in/in1101/in11019765/in1101976502@2x.jpg'),
(34, 'Gigabyte X570 AORUS XTREME', 'Gigabyte', 'CarteMere', 790, 2, 'https://www.topachat.com/boutique/img/in/in1101/in11017718/in1101771802@2x.jpg'),
(35, 'Gigabyte X299X AORUS XTREME WATERFORCE', 'Gigabyte', 'CarteMere', 1673, 0, 'https://www.topachat.com/boutique/img/in/in1101/in11019802/in1101980202@2x.jpg'),
(36, 'Gigabyte Z390 AORUS ULTRA', 'Gigabyte', 'CarteMere', 269, 6, 'https://www.topachat.com/boutique/img/in/in1011/in10114627/in1011462702@2x.jpg'),
(37, 'EVGA 450 BT, 450W', 'EVGA', 'Alimentation', 40, 2, 'https://www.topachat.com/boutique/img/in/in1010/in10106253/in1010625302@2x.jpg'),
(38, 'Corsair AX1600i, 1600W', 'Corsair', 'Alimentation', 446, 8, 'https://www.topachat.com/boutique/img/in/in1011/in10110206/in1011020602@2x.jpg'),
(39, 'Cooler Master K450, 450W', 'CoolerMaster', 'Alimentation', 30, 28, 'https://www.topachat.com/boutique/img/in/in1011/in10110197/in1011019702@2x.jpg'),
(40, 'Samsung Série 960 Pro, 2 To, M.2 (Type 2280)', 'Samsung', 'SSD', 1160, 5, 'https://www.topachat.com/boutique/img/in/in1010/in10100683/in1010068302.jpg'),
(41, 'Seagate IronWolf 110, 3.84 To, SATA III', 'Seagate', 'SSD', 836, 3, 'https://www.topachat.com/boutique/img/in/in1101/in11016820/in1101682002@2x.jpg'),
(42, 'Aorus NVMe SSD, 2 To (PCI-Express 4.0)', 'Gigabyte', 'SSD', 483, 7, 'https://www.topachat.com/boutique/img/in/in1101/in11017753/in1101775302@2x.jpg'),
(43, 'Corsair Force MP600, 2 To, M.2 (PCI-Express 4.0)', 'Corsair', 'SSD', 483, 5, 'https://www.topachat.com/boutique/img/in/in1101/in11017423/in1101742302@2x.jpg'),
(44, 'Sandisk SSD PLUS TLC, 1 To, SATA III', 'Sandisk', 'SSD', 112, 17, 'https://www.topachat.com/boutique/img/in/in1011/in10115835/in1011583502.jpg'),
(46, 'Western Digital WD Black, 4 To', 'WesternDigital', 'DisqueDur', 205, 9, 'https://www.topachat.com/boutique/img/in/in1011/in10117303/in1011730302@2x.jpg'),
(48, 'Intel Core i9-9820X (3.3 GHz)', 'Intel', 'Processeur', 836, 7, 'https://www.topachat.com/boutique/img/in/in1011/in10115959/in1011595902.jpg'),
(49, 'AORUS GeForce RTX 2080 SUPER 8G, 8 Go', 'Gigabyte', 'CarteGraphique', 827, 2, 'https://www.topachat.com/boutique/img/in/in1101/in11017440/in1101744002@2x.jpg'),
(50, 'KFA2 GeForce RTX 2080 Ti HOF 10th Anniversary, 11 Go', 'KFA2', 'CarteGraphique', 1785, 4, 'https://www.topachat.com/boutique/img/in/in1101/in11018036/in1101803602@2x.jpg'),
(51, 'MSI GeForce RTX 2080 Ti VENTUS GP, 11 Go', 'MSI', 'CarteGraphique', 1200, 12, 'https://www.topachat.com/boutique/img/in/in1101/in11019638/in1101963802@2x.jpg'),
(52, 'KFA2 GeForce RTX 2080 Ti EX (1-Click OC), 11 Go', 'KFA2', 'CarteGraphique', 999, 17, 'https://www.topachat.com/boutique/img/in/in1101/in11017710/in1101771002@2x.jpg'),
(53, 'Asus Radeon TUF RX 5700 XT O8G, 8 Go', 'Asus', 'CarteGraphique', 402, 12, 'https://www.topachat.com/boutique/img/in/in1101/in11018112/in1101811202@2x.jpg'),
(54, 'Crucial MX500, 500 Go, SATA III', 'Crucial', 'SSD', 71, 13, 'https://www.topachat.com/boutique/img/in/in1010/in10109580/in1010958002.jpg'),
(55, 'Western Digital WD Red, 2 To', 'WesternDigital', 'DisqueDur', 86, 9, 'https://www.topachat.com/boutique/img/in/in1011/in10118721/in1011872102@2x.jpg'),
(56, 'Intel Core i7-9700K (3.6 GHz)', 'Intel', 'Processeur', 415, 5, 'https://www.topachat.com/boutique/img/in/in1011/in10114554/in1011455402@2x.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `SSD`
--

CREATE TABLE `SSD` (
  `refSSD` int(11) NOT NULL,
  `format` varchar(20) NOT NULL,
  `capacite` int(20) NOT NULL,
  `interface` varchar(20) NOT NULL,
  `lecture` int(8) NOT NULL,
  `ecriture` int(8) NOT NULL,
  `refProduit` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `SSD`
--

INSERT INTO `SSD` (`refSSD`, `format`, `capacite`, `interface`, `lecture`, `ecriture`, `refProduit`) VALUES
(1, 'M.2 (Type 2280)', 500, 'NVMe (PCI-E 3.0 4x)', 3500, 2500, 7),
(2, '2.5\" / 7 mm d\'épaiss', 240, 'SATA III', 540, 500, 15),
(3, 'M.2 (Type 2280)', 2000, 'NVMe (PCI-E 3.0 4x)', 3500, 2100, 40),
(4, '2,5\"', 3840, 'SATA III - 6 Gb/s', 560, 535, 41),
(5, 'M.2 (Type 2280)', 2000, 'NVMe (PCI-E 4.0 4x)', 5000, 4400, 42),
(6, 'M.2 (Type 2280)', 2000, 'NVMe (PCI-E 4.0 4x)', 4950, 4250, 43),
(7, '2,5\"', 1000, 'SATA III', 535, 450, 44),
(8, '2.5\" / 7 mm d\'épaiss', 500, 'SATA III', 560, 510, 54);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Alimentation`
--
ALTER TABLE `Alimentation`
  ADD PRIMARY KEY (`refAlim`),
  ADD UNIQUE KEY `refProduit` (`refProduit`);

--
-- Index pour la table `Avis`
--
ALTER TABLE `Avis`
  ADD PRIMARY KEY (`idClient`,`refProduit`),
  ADD KEY `AvisProduit` (`refProduit`);

--
-- Index pour la table `CarteGraphique`
--
ALTER TABLE `CarteGraphique`
  ADD PRIMARY KEY (`refCG`),
  ADD UNIQUE KEY `refProduit` (`refProduit`);

--
-- Index pour la table `CarteMere`
--
ALTER TABLE `CarteMere`
  ADD PRIMARY KEY (`refCM`),
  ADD UNIQUE KEY `refProduit` (`refProduit`);

--
-- Index pour la table `Clients`
--
ALTER TABLE `Clients`
  ADD PRIMARY KEY (`idClient`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Index pour la table `Commandes`
--
ALTER TABLE `Commandes`
  ADD PRIMARY KEY (`idCommande`),
  ADD KEY `idClient` (`idClient`);

--
-- Index pour la table `DisqueDur`
--
ALTER TABLE `DisqueDur`
  ADD PRIMARY KEY (`refHDD`),
  ADD KEY `HDDProduit` (`refProduit`);

--
-- Index pour la table `ListeCommander`
--
ALTER TABLE `ListeCommander`
  ADD PRIMARY KEY (`idCommande`,`refProduit`),
  ADD KEY `CommandeListeProduits` (`refProduit`);

--
-- Index pour la table `Memoire`
--
ALTER TABLE `Memoire`
  ADD PRIMARY KEY (`refRAM`),
  ADD UNIQUE KEY `refProduit` (`refProduit`);

--
-- Index pour la table `Panier`
--
ALTER TABLE `Panier`
  ADD PRIMARY KEY (`idClient`,`refProduit`),
  ADD KEY `PanierProduits` (`refProduit`);

--
-- Index pour la table `Processeur`
--
ALTER TABLE `Processeur`
  ADD PRIMARY KEY (`refCPU`),
  ADD UNIQUE KEY `refProduit` (`refProduit`);

--
-- Index pour la table `Produits`
--
ALTER TABLE `Produits`
  ADD PRIMARY KEY (`refProduit`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Index pour la table `SSD`
--
ALTER TABLE `SSD`
  ADD PRIMARY KEY (`refSSD`),
  ADD UNIQUE KEY `refProduit` (`refProduit`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Alimentation`
--
ALTER TABLE `Alimentation`
  MODIFY `refAlim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `CarteGraphique`
--
ALTER TABLE `CarteGraphique`
  MODIFY `refCG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `CarteMere`
--
ALTER TABLE `CarteMere`
  MODIFY `refCM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `Clients`
--
ALTER TABLE `Clients`
  MODIFY `idClient` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT pour la table `Commandes`
--
ALTER TABLE `Commandes`
  MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `DisqueDur`
--
ALTER TABLE `DisqueDur`
  MODIFY `refHDD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Memoire`
--
ALTER TABLE `Memoire`
  MODIFY `refRAM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `Processeur`
--
ALTER TABLE `Processeur`
  MODIFY `refCPU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `Produits`
--
ALTER TABLE `Produits`
  MODIFY `refProduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT pour la table `SSD`
--
ALTER TABLE `SSD`
  MODIFY `refSSD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Alimentation`
--
ALTER TABLE `Alimentation`
  ADD CONSTRAINT `ALIMPorduit` FOREIGN KEY (`refProduit`) REFERENCES `Produits` (`refProduit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Avis`
--
ALTER TABLE `Avis`
  ADD CONSTRAINT `AvisClient` FOREIGN KEY (`idClient`) REFERENCES `Clients` (`idClient`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `AvisProduit` FOREIGN KEY (`refProduit`) REFERENCES `Produits` (`refProduit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `CarteGraphique`
--
ALTER TABLE `CarteGraphique`
  ADD CONSTRAINT `GPUProduit` FOREIGN KEY (`refProduit`) REFERENCES `Produits` (`refProduit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `CarteMere`
--
ALTER TABLE `CarteMere`
  ADD CONSTRAINT `CMProduit` FOREIGN KEY (`refProduit`) REFERENCES `Produits` (`refProduit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Commandes`
--
ALTER TABLE `Commandes`
  ADD CONSTRAINT `ClientCommande` FOREIGN KEY (`idClient`) REFERENCES `Clients` (`idClient`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `DisqueDur`
--
ALTER TABLE `DisqueDur`
  ADD CONSTRAINT `HDDProduit` FOREIGN KEY (`refProduit`) REFERENCES `Produits` (`refProduit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ListeCommander`
--
ALTER TABLE `ListeCommander`
  ADD CONSTRAINT `CommandeListeProduits` FOREIGN KEY (`refProduit`) REFERENCES `Produits` (`refProduit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `CommanderListeComander` FOREIGN KEY (`idCommande`) REFERENCES `Commandes` (`idCommande`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Memoire`
--
ALTER TABLE `Memoire`
  ADD CONSTRAINT `RAMProduits` FOREIGN KEY (`refProduit`) REFERENCES `Produits` (`refProduit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Panier`
--
ALTER TABLE `Panier`
  ADD CONSTRAINT `PanierClient` FOREIGN KEY (`idClient`) REFERENCES `Clients` (`idClient`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `PanierProduits` FOREIGN KEY (`refProduit`) REFERENCES `Produits` (`refProduit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Processeur`
--
ALTER TABLE `Processeur`
  ADD CONSTRAINT `CPUProduits` FOREIGN KEY (`refProduit`) REFERENCES `Produits` (`refProduit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `SSD`
--
ALTER TABLE `SSD`
  ADD CONSTRAINT `SSDPorduit` FOREIGN KEY (`refProduit`) REFERENCES `Produits` (`refProduit`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

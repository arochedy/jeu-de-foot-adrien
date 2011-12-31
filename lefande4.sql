-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Sam 31 Décembre 2011 à 10:32
-- Version du serveur: 5.5.8
-- Version de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `lefande4`
--

-- --------------------------------------------------------

--
-- Structure de la table `cdf`
--

CREATE TABLE IF NOT EXISTS `cdf` (
  `idcdf` int(11) NOT NULL AUTO_INCREMENT,
  `idclub` int(11) NOT NULL,
  `niveau` int(20) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idcdf`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `cdf`
--

INSERT INTO `cdf` (`idcdf`, `idclub`, `niveau`) VALUES
(1, 6, 2),
(4, 8, 20);

-- --------------------------------------------------------

--
-- Structure de la table `championnat`
--

CREATE TABLE IF NOT EXISTS `championnat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idchamp` int(11) NOT NULL,
  `division` int(11) NOT NULL,
  `nom` text NOT NULL,
  `e1` int(25) NOT NULL DEFAULT '0',
  `e2` int(25) NOT NULL DEFAULT '0',
  `e3` int(11) NOT NULL DEFAULT '0',
  `e4` int(11) NOT NULL DEFAULT '0',
  `e5` int(11) NOT NULL DEFAULT '0',
  `e6` int(11) NOT NULL DEFAULT '0',
  `e7` int(11) NOT NULL DEFAULT '0',
  `e8` int(11) NOT NULL DEFAULT '0',
  `e9` int(11) NOT NULL DEFAULT '0',
  `e10` int(11) NOT NULL DEFAULT '0',
  `plein` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `championnat`
--

INSERT INTO `championnat` (`id`, `idchamp`, `division`, `nom`, `e1`, `e2`, `e3`, `e4`, `e5`, `e6`, `e7`, `e8`, `e9`, `e10`, `plein`) VALUES
(1, 1, 1, 'France', 6, 8, 11, 12, 13, 14, 15, 16, 17, 18, 1);

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

CREATE TABLE IF NOT EXISTS `joueur` (
  `idjoueur` int(11) NOT NULL AUTO_INCREMENT,
  `idclub` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `taille` varchar(3) NOT NULL,
  `age` varchar(2) NOT NULL,
  `poste` enum('GAC','DFC','DFD','DFG','MDC','MOC','MOD','MOG','ATC') NOT NULL,
  `talent` int(2) NOT NULL,
  `PE` int(11) NOT NULL DEFAULT '0',
  `gardien` int(2) NOT NULL DEFAULT '1',
  `defense` int(2) NOT NULL DEFAULT '1',
  `attaque` int(2) NOT NULL DEFAULT '1',
  `endurance` int(2) NOT NULL DEFAULT '1',
  `titulaire` int(11) NOT NULL DEFAULT '0',
  `physique` int(99) NOT NULL,
  PRIMARY KEY (`idjoueur`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Contenu de la table `joueur`
--

INSERT INTO `joueur` (`idjoueur`, `idclub`, `nom`, `prenom`, `taille`, `age`, `poste`, `talent`, `PE`, `gardien`, `defense`, `attaque`, `endurance`, `titulaire`, `physique`) VALUES
(1, 6, 'ROCHEDY', 'Adrien', '180', '20', 'DFC', 7, 39, 1, 3, 13, 3, 1, 51),
(2, 8, 'ROCHEDY', 'Quentin', '180', '20', 'ATC', 7, 189, 1, 1, 1, 1, 1, 50),
(3, 6, 'THURAM', 'Lilian', '112', '38', 'DFC', 65, 315, 1, 7, 1, 101, 0, 99),
(4, 6, 'DESAILLY', 'Marcel', '150', '38', 'DFC', 65, 15, 3, 8, 2, 6, 1, 99),
(5, 6, 'BLANC', 'Laurent', '150', '38', 'DFC', 65, 55, 2, 8, 5, 3, 1, 51),
(7, 8, 'Abdoul	\n', 'Aaron	\r\n', '', '23', 'MOD', 15, 405, 18, 12, 6, 17, 1, 58),
(8, 6, 'Achille	\n', 'Abou	\r\n', '', '32', 'DFD', 22, 94, 1, 11, 6, 11, 1, 55),
(9, 7, 'Adolphe	\n', 'Adam	\r\n', '', '20', 'GAC', 14, 84, 6, 6, 11, 18, 1, 99),
(10, 7, 'Abdelhadi	\n', 'Abdessamad	\r\n', '', '33', 'MOG', 8, 48, 9, 13, 14, 7, 1, 99),
(11, 7, 'Aboubakary	\n', 'Abderrahim	\r\n', '', '25', 'MOD', 9, 54, 17, 5, 3, 6, 1, 99),
(12, 8, 'Abdelhalim	\n', 'Abdallah	\r\n', '185', '20', 'MOD', 15, 405, 13, 4, 13, 12, 1, 55),
(13, 7, 'Abou	\n', 'Abdellah	\r\n', '162', '31', 'MOG', 25, 150, 14, 1, 3, 11, 1, 99),
(14, 8, 'Aboubakary	\n', 'Abdelmajid	\r\n', '170', '35', 'MDC', 14, 378, 13, 15, 13, 10, 1, 54),
(15, 6, 'Abdelmalik	\n', 'Adem	\r\n', '200', '28', 'GAC', 14, 294, 12, 20, 4, 16, 0, 99),
(16, 8, 'Abdallah	\n', 'Abdessamad	\r\n', '201', '34', 'ATC', 27, 729, 10, 9, 10, 5, 1, 52),
(17, 8, 'Perrin\n', 'Abdeljalil	\r\n', '199', '32', 'MDC', 13, 301, 20, 2, 15, 9, 1, 54),
(18, 10, 'Fournier 	\n', 'Abdelhak	\r\n', '177', '18', 'MDC', 24, 144, 3, 18, 5, 12, 1, 99),
(19, 6, 'Martinez 	\n', 'Abdou	\r\n', '179', '21', 'ATC', 24, 48, 7, 3, 11, 14, 1, 56),
(20, 7, 'Moreau 	\n', 'Abdessamad	\r\n', '191', '18', 'DFG', 22, 0, 12, 7, 14, 18, 0, 99),
(21, 6, 'Lefebvre 	 \n', 'Aboubacar	\r\n', '177', '35', 'DFG', 14, 228, 15, 12, 18, 4, 1, 51),
(22, 6, 'Fournier 	\n', 'Jocelyn	\r\n', '193', '17', 'DFD', 14, 378, 12, 16, 6, 12, 1, 55),
(23, 6, 'Lefebvre 	 \n', 'Jonas	\r\n', '165', '26', 'DFC', 9, 243, 16, 16, 1, 16, 1, 57),
(24, 8, 'Roux 	\n', 'Jean	\r\n', '179', '17', 'DFG', 27, 729, 6, 17, 7, 16, 1, 57),
(25, 7, 'Gauthier\n', 'Joackim	\r\n', '169', '23', 'MDC', 19, 114, 6, 18, 7, 17, 1, 99),
(26, 7, 'Legrand 	\n', 'Aime	\r\n', '173', '34', 'MDC', 13, 78, 10, 6, 18, 5, 1, 99),
(27, 6, 'Lopez\n', 'Jonathan	\r\n', '182', '25', 'MOD', 19, 17, 12, 11, 10, 17, 0, 99),
(28, 7, 'Durand 	\n', 'Johny	\r\n', '174', '24', 'DFG', 18, 108, 12, 12, 18, 1, 1, 99),
(29, 8, 'Durand 	\n', 'John	\r\n', '196', '21', 'GAC', 21, 567, 4, 18, 6, 15, 1, 57),
(30, 7, 'Morin\n', 'Jimmy	\r\n', '162', '29', 'DFG', 24, 144, 16, 18, 16, 8, 1, 99),
(31, 8, 'Thomas 		\n', 'Jonas	\r\n', '198', '30', 'DFC', 9, 243, 5, 19, 11, 2, 1, 50),
(32, 7, 'Nicolas 	\n', 'Jerry	\r\n', '203', '27', 'MOG', 18, 108, 5, 2, 16, 9, 1, 99),
(33, 8, 'Leroy 	\n', 'Aime	\r\n', '173', '31', 'ATC', 27, 629, 3, 9, 13, 7, 1, 53),
(34, 7, 'Garcia\n', 'Jeff	\r\n', '200', '32', 'MOG', 12, 72, 9, 14, 3, 8, 1, 99),
(35, 7, 'Morin\n', 'Jesse	\r\n', '178', '25', 'MOG', 22, 132, 14, 12, 18, 17, 1, 99),
(36, 7, 'Lopez\n', 'Jeffrey	\r\n', '203', '18', 'DFC', 7, 82, 14, 14, 19, 1, 0, 99),
(37, 7, 'Muller 	 \n', 'Jesus	\r\n', '186', '26', 'DFG', 21, 144, 7, 16, 3, 19, 0, 99),
(38, 7, 'Bernard 	\n', 'Jefferson	\r\n', '166', '26', 'MOG', 12, 104, 2, 18, 16, 20, 0, 99),
(39, 7, 'Morin\n', 'John	\r\n', '171', '35', 'MOC', 15, 140, 19, 15, 17, 10, 0, 99),
(40, 7, 'Lambert 	\n', 'Joao	\r\n', '175', '25', 'DFD', 12, 62, 9, 6, 3, 2, 0, 99),
(41, 7, 'Roussel 	\n', 'Johanny	\r\n', '205', '31', 'DFG', 11, 112, 13, 3, 1, 19, 0, 99),
(42, 7, 'Francois 	\n', 'Jibril	\r\n', '173', '28', 'ATC', 16, 179, 11, 8, 11, 14, 0, 99),
(43, 7, 'Henry 	\n', 'Jessime	\r\n', '189', '32', 'DFG', 17, 141, 3, 14, 13, 15, 0, 99),
(44, 7, 'Dupont 	\n', 'Jonathan	\r\n', '187', '28', 'ATC', 24, 155, 11, 11, 3, 16, 0, 99),
(45, 7, 'Legrand 	\n', 'Jeoffrey	\r\n', '182', '30', 'MDC', 17, 18, 13, 7, 15, 19, 0, 99),
(46, 7, 'Bertrand 	\n', 'Johan	\r\n', '191', '35', 'MOG', 24, 172, 17, 19, 8, 19, 0, 99),
(47, 7, 'Garcia\n', 'Adrian	\r\n', '175', '31', 'MOC', 10, 120, 16, 7, 9, 14, 0, 99),
(48, 7, 'Blanc 	\n', 'Jim	\r\n', '187', '31', 'ATC', 26, 79, 7, 16, 15, 3, 0, 99),
(49, 7, 'Gauthier\n', 'Joel	\r\n', '189', '30', 'DFC', 14, 71, 13, 13, 13, 8, 0, 99),
(50, 8, 'Gauthier\n', 'Johann	\r\n', '161', '17', 'ATC', 13, 352, 10, 10, 12, 18, 1, 58),
(51, 7, 'Clement\n', 'Jesse	\r\n', '175', '18', 'DFC', 9, 185, 3, 19, 16, 9, 0, 99),
(52, 7, 'Gauthier\n', 'Jibril	\r\n', '203', '33', 'ATC', 22, 164, 15, 11, 16, 13, 0, 99),
(53, 6, 'Dumont\n', 'Jonah	\r\n', '202', '30', 'MOD', 24, 534, 12, 18, 17, 14, 1, 56),
(54, 7, 'Fontaine\n', 'John	\r\n', '162', '35', 'MOD', 19, 142, 20, 5, 1, 15, 0, 99),
(55, 7, 'Dumont\n', 'Jim	\r\n', '172', '23', 'DFD', 22, 167, 12, 19, 15, 11, 0, 99),
(56, 7, 'Bernard 	\n', 'Jon	\r\n', '187', '31', 'DFG', 10, 28, 2, 10, 14, 4, 0, 99),
(57, 6, 'Lefevre 	 \n', 'Jeff	\r\n', '195', '18', 'GAC', 5, 31, 1, 1, 1, 1, 1, 50),
(59, 7, 'Henry 	\n', 'Joaquim	\r\n', '194', '17', 'DFC', 3, 1, 1, 1, 1, 1, 0, 99),
(60, 6, 'Bertrand 	\n', 'Johanny	\r\n', '176', '17', 'MOD', 5, 1, 1, 1, 1, 1, 0, 99),
(61, 6, 'Mathieu\n', 'Joffrey	\r\n', '160', '17', 'MOD', 1, 1, 1, 1, 1, 1, 0, 99),
(65, 6, 'Mathieu\n', 'Joffrey	\r\n', '197', '17', 'MOD', 1, 1, 1, 1, 1, 1, 0, 99),
(66, 6, 'Henry 	\n', 'John	\r\n', '180', '18', 'DFC', 1, 7, 1, 1, 1, 1, 0, 50),
(67, 6, 'Blanc 	\n', 'Adriano	\r\n', '171', '17', 'DFC', 17, 3, 1, 2, 1, 2, 1, 50),
(68, 8, 'Garnier 		\n', 'Adriano	\r\n', '161', '17', 'GAC', 100, 1, 1, 1, 1, 1, 0, 99),
(69, 8, 'Clement\n', 'Adrien	\r\n', '183', '18', 'MOG', 100, 1, 1, 1, 1, 1, 0, 99),
(70, 8, 'Bonnet 	\n', 'Joanny	\r\n', '192', '17', 'MOC', 100, 1, 1, 1, 1, 1, 0, 99),
(71, 8, 'Lopez\n', 'Joannes	\r\n', '204', '17', 'MDC', 100, 1, 1, 1, 1, 1, 0, 99),
(72, 8, 'Mathieu\n', 'Johnny	\r\n', '193', '17', 'DFD', 100, 1, 1, 1, 1, 1, 0, 99),
(73, 8, 'Robin', 'Jesus	\r\n', '165', '17', 'DFC', 100, 1, 1, 1, 1, 1, 0, 99),
(74, 8, 'Francois 	\n', 'Johny	\r\n', '161', '17', 'MDC', 4, 1, 1, 1, 1, 1, 0, 99),
(75, 6, 'Laurent 	 \n', 'John	\r\n', '177', '18', 'DFC', 10, 1, 1, 1, 1, 1, 0, 99),
(76, 6, 'Petit 	\n', 'John	\r\n', '164', '18', 'ATC', 9, 1, 1, 1, 1, 1, 0, 99),
(77, 6, 'Morin\n', 'Joao	\r\n', '196', '18', 'MOC', 9, 1, 1, 1, 1, 1, 0, 99),
(78, 6, 'Martin 	\n', 'Jesus	\r\n', '202', '18', 'DFC', 1, 1, 1, 1, 1, 1, 0, 99),
(79, 6, 'Lefevre 	 \n', 'Joel	\r\n', '192', '17', 'GAC', 1, 1, 1, 1, 1, 1, 0, 99),
(80, 6, 'Chevalier\n', 'Jefferson	\r\n', '175', '18', 'MOD', 23, 1, 1, 1, 1, 1, 0, 99);

-- --------------------------------------------------------

--
-- Structure de la table `juniors`
--

CREATE TABLE IF NOT EXISTS `juniors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idclub` int(11) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `poste` enum('GAC','DFC','DFD','DFG','MDC','MOC','MOD','MOG','ATC') NOT NULL,
  `age` int(99) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Contenu de la table `juniors`
--

INSERT INTO `juniors` (`id`, `idclub`, `nom`, `prenom`, `poste`, `age`, `date`) VALUES
(36, 8, 'Moreau 	\n', 'Jonah	\r\n', 'MDC', 17, '2010-11-13'),
(35, 8, 'Francois 	\n', 'Jonas	\r\n', 'DFC', 17, '2010-11-13');

-- --------------------------------------------------------

--
-- Structure de la table `match`
--

CREATE TABLE IF NOT EXISTS `match` (
  `idmatch` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `iddom` int(11) NOT NULL,
  `idext` int(11) NOT NULL,
  `valide` int(11) NOT NULL DEFAULT '0',
  `fini` int(11) NOT NULL DEFAULT '0',
  `scoredom` int(11) NOT NULL DEFAULT '-1',
  `scoreext` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`idmatch`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Contenu de la table `match`
--

INSERT INTO `match` (`idmatch`, `date`, `iddom`, `idext`, `valide`, `fini`, `scoredom`, `scoreext`) VALUES
(26, '2010-10-24', 6, 8, 1, 1, 0, 1),
(24, '2010-08-25', 8, 6, 0, 0, 0, 0),
(23, '2010-08-30', 6, 8, 1, 0, 0, 0),
(22, '2010-08-27', 7, 8, 1, 1, 1, 1),
(21, '2010-08-27', 6, 6, 1, 1, 0, 0),
(27, '2010-10-27', 6, 8, 1, 0, 0, 0),
(28, '2010-10-28', 6, 8, 1, 1, 0, 1),
(29, '2010-10-30', 6, 8, 1, 1, 0, 0),
(30, '2010-10-31', 6, 8, 1, 1, 0, 0),
(31, '2010-11-13', 6, 8, 1, 1, 0, 0),
(32, '2010-11-23', 6, 8, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` text NOT NULL,
  `pass_md5` text NOT NULL,
  `nomclub` text NOT NULL,
  `datedecreation` date NOT NULL,
  `niveau` int(20) NOT NULL DEFAULT '1',
  `argent` int(11) NOT NULL DEFAULT '500000',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id`, `login`, `pass_md5`, `nomclub`, `datedecreation`, `niveau`, `argent`) VALUES
(7, 'admin', '102bdee8c294f0aa986eb6c7dcc55ee6', 'admin', '0000-00-00', 1, 500000),
(6, 'lefandesverts', '102bdee8c294f0aa986eb6c7dcc55ee6', 'asse', '0000-00-00', 1, 101000),
(8, 'adrien', '102bdee8c294f0aa986eb6c7dcc55ee6', 'adrien', '2010-08-05', 1, 951199999),
(10, 'testststade', '102bdee8c294f0aa986eb6c7dcc55ee6', 'stade', '2010-10-30', 1, 500000),
(11, 'equipe1', '102bdee8c294f0aa986eb6c7dcc55ee6', 'equipe1', '0000-00-00', 1, 500000),
(12, 'equipe2', '102bdee8c294f0aa986eb6c7dcc55ee6', 'equipe2', '0000-00-00', 1, 500000),
(13, 'equipe3', '102bdee8c294f0aa986eb6c7dcc55ee6', 'equipe3', '2010-11-14', 1, 500000),
(14, 'equipe4', '102bdee8c294f0aa986eb6c7dcc55ee6', 'equipe4', '2010-11-14', 1, 500000),
(15, 'equipe5', '102bdee8c294f0aa986eb6c7dcc55ee6', 'equipe5', '2010-11-14', 1, 500000),
(16, 'equipe6', '102bdee8c294f0aa986eb6c7dcc55ee6', 'equipe6', '2010-11-14', 1, 500000),
(17, 'equipe7', '102bdee8c294f0aa986eb6c7dcc55ee6', 'equipe7', '2010-11-14', 1, 500000),
(18, 'equipe8', '102bdee8c294f0aa986eb6c7dcc55ee6', 'equipe8', '2010-11-14', 1, 500000);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_expediteur` int(11) NOT NULL DEFAULT '0',
  `id_destinataire` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `titre` text NOT NULL,
  `message` text NOT NULL,
  `lu` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=98 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `id_expediteur`, `id_destinataire`, `date`, `titre`, `message`, `lu`) VALUES
(72, 7, 6, '2010-08-27 09:45:34', 'Rapport de Match', 'Le match du jour est terminé !<br> Résultat : 0-0<br>Cliquer <a href="match.php?id=21">ici</a> pour voir le résumé du match', 1),
(70, 7, 7, '2010-08-27 09:45:34', 'Rapport de Match', 'Le match du jour est terminé !<br> Résultat : 1-1<br>Cliquer <a href="match.php?id=22">ici</a> pour voir le résumé du match', 0),
(71, 7, 8, '2010-08-27 09:45:34', 'Rapport de Match', 'Le match du jour est terminé !<br> Résultat : 1-1<br>Cliquer <a href="match.php?id=22">ici</a> pour voir le résumé du match', 1),
(69, 7, 8, '2010-08-27 09:18:26', 'Demande de match', 'admin&nbsp;vous a fait une demande de match<br>Cliquer <a href="valider.php">ici</a> pour valider', 1),
(68, 7, 6, '2010-08-27 08:25:53', 'Demande de match', 'asse&nbsp;vous a fait une demande de match<br>Cliquer <a href="valider.php">ici</a> pour valider', 1),
(73, 7, 6, '2010-08-27 09:45:34', 'Rapport de Match', 'Le match du jour est terminé !<br> Résultat : 0-0<br>Cliquer <a href="match.php?id=21">ici</a> pour voir le résumé du match', 1),
(74, 7, 8, '2010-08-27 10:24:18', 'Demande de match', 'asse&nbsp;vous a fait une demande de match<br>Cliquer <a href="valider.php">ici</a> pour valider', 1),
(77, 7, 8, '2010-10-24 18:49:49', 'Demande de match', 'asse&nbsp;vous a fait une demande de match<br>Cliquer <a href="valider.php">ici</a> pour valider', 1),
(76, 7, 8, '2010-08-27 10:45:50', 'Demande de match', 'asse&nbsp;vous a fait une demande de match<br>Cliquer <a href="valider.php">ici</a> pour valider', 1),
(78, 7, 6, '2010-10-24 18:51:17', 'Rapport de Match', 'Le match du jour est terminé !<br> Résultat : 0-1<br>Cliquer <a href="match.php?id=26">ici</a> pour voir le résumé du match', 1),
(79, 7, 8, '2010-10-24 18:51:17', 'Rapport de Match', 'Le match du jour est terminé !<br> Résultat : 0-1<br>Cliquer <a href="match.php?id=26">ici</a> pour voir le résumé du match', 1),
(80, 7, 8, '2010-10-24 19:06:11', 'Demande de match', 'asse&nbsp;vous a fait une demande de match<br>Cliquer <a href="valider.php">ici</a> pour valider', 1),
(81, 7, 8, '2010-10-28 21:11:46', 'Demande de match', 'asse&nbsp;vous a fait une demande de match<br>Cliquer <a href="valider.php">ici</a> pour valider', 1),
(82, 7, 6, '2010-10-28 21:17:33', 'Rapport de Match', 'Le match du jour est terminé !<br> Résultat : 0-1<br>Cliquer <a href="match.php?id=28">ici</a> pour voir le résumé du match', 1),
(83, 7, 8, '2010-10-28 21:17:33', 'Rapport de Match', 'Le match du jour est terminé !<br> Résultat : 0-1<br>Cliquer <a href="match.php?id=28">ici</a> pour voir le résumé du match', 1),
(84, 7, 6, '2010-10-28 21:18:46', 'Rapport de Match', 'Le match du jour est terminé !<br> Résultat : 0-1<br>Cliquer <a href="match.php?id=28">ici</a> pour voir le résumé du match', 1),
(85, 7, 8, '2010-10-28 21:18:46', 'Rapport de Match', 'Le match du jour est terminé !<br> Résultat : 0-1<br>Cliquer <a href="match.php?id=28">ici</a> pour voir le résumé du match', 1),
(86, 7, 6, '2010-10-28 21:26:02', 'Rapport de Match', 'Le match du jour est terminé !<br> Résultat : 0-1<br>Cliquer <a href="match.php?id=28">ici</a> pour voir le résumé du match', 1),
(87, 7, 8, '2010-10-28 21:26:02', 'Rapport de Match', 'Le match du jour est terminé !<br> Résultat : 0-1<br>Cliquer <a href="match.php?id=28">ici</a> pour voir le résumé du match', 1),
(88, 7, 8, '2010-10-30 21:05:46', 'Demande de match', 'asse&nbsp;vous a fait une demande de match<br>Cliquer <a href="valider.php">ici</a> pour valider', 1),
(89, 7, 6, '2010-10-30 21:07:38', 'Rapport de Match', 'Le match du jour est terminé !<br> Résultat : 0-0<br>Cliquer <a href="match.php?id=29">ici</a> pour voir le résumé du match', 1),
(90, 7, 8, '2010-10-30 21:07:38', 'Rapport de Match', 'Le match du jour est terminé !<br> Résultat : 0-0<br>Cliquer <a href="match.php?id=29">ici</a> pour voir le résumé du match', 1),
(91, 7, 8, '2010-10-31 19:24:55', 'Demande de match', 'asse&nbsp;vous a fait une demande de match<br>Cliquer <a href="valider.php">ici</a> pour valider', 1),
(92, 7, 6, '2010-10-31 19:25:29', 'Rapport de Match', 'Le match du jour est terminé !<br> Résultat : 0-0<br>Cliquer <a href="match.php?id=30">ici</a> pour voir le résumé du match', 1),
(93, 7, 8, '2010-10-31 19:25:29', 'Rapport de Match', 'Le match du jour est terminé !<br> Résultat : 0-0<br>Cliquer <a href="match.php?id=30">ici</a> pour voir le résumé du match', 1),
(94, 7, 8, '2010-11-13 19:33:39', 'Demande de match', 'asse&nbsp;vous a fait une demande de match<br>Cliquer <a href="valider.php">ici</a> pour valider', 1),
(95, 7, 6, '2010-11-13 19:34:25', 'Rapport de Match', 'Le match du jour est terminé !<br> Résultat : 0-0<br>Cliquer <a href="match.php?id=31">ici</a> pour voir le résumé du match', 1),
(96, 7, 8, '2010-11-13 19:34:25', 'Rapport de Match', 'Le match du jour est terminé !<br> Résultat : 0-0<br>Cliquer <a href="match.php?id=31">ici</a> pour voir le résumé du match', 1),
(97, 7, 8, '2010-11-13 19:40:40', 'Demande de match', 'asse&nbsp;vous a fait une demande de match<br>Cliquer <a href="valider.php">ici</a> pour valider', 1);

-- --------------------------------------------------------

--
-- Structure de la table `points`
--

CREATE TABLE IF NOT EXISTS `points` (
  `idclub` int(11) NOT NULL,
  `idchamp` int(11) NOT NULL,
  `division` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `victoire` int(11) NOT NULL,
  `nul` int(11) NOT NULL,
  `defaite` int(11) NOT NULL,
  `bp` int(11) NOT NULL,
  `bc` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `points`
--

INSERT INTO `points` (`idclub`, `idchamp`, `division`, `points`, `victoire`, `nul`, `defaite`, `bp`, `bc`) VALUES
(6, 1, 1, 0, 0, 0, 0, 0, 0),
(11, 1, 1, 0, 0, 0, 0, 0, 0),
(12, 1, 1, 0, 0, 0, 0, 0, 0),
(13, 1, 1, 0, 0, 0, 0, 0, 0),
(8, 1, 1, 0, 0, 0, 0, 0, 0),
(14, 1, 1, 0, 0, 0, 0, 0, 0),
(15, 1, 1, 0, 0, 0, 0, 0, 0),
(16, 1, 1, 0, 0, 0, 0, 0, 0),
(17, 1, 1, 0, 0, 0, 0, 0, 0),
(18, 1, 1, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `stade`
--

CREATE TABLE IF NOT EXISTS `stade` (
  `idstade` int(11) NOT NULL AUTO_INCREMENT,
  `idclub` int(11) NOT NULL,
  `places` int(11) NOT NULL DEFAULT '5000',
  `nom` varchar(50) NOT NULL DEFAULT 'Stade municipal',
  PRIMARY KEY (`idstade`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `stade`
--

INSERT INTO `stade` (`idstade`, `idclub`, `places`, `nom`) VALUES
(3, 6, 5000, 'Stade municipal'),
(4, 8, 5000, 'Stade municipal'),
(6, 10, 5000, '');

-- --------------------------------------------------------

--
-- Structure de la table `tactiqueclub`
--

CREATE TABLE IF NOT EXISTS `tactiqueclub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtactique` int(11) NOT NULL,
  `idclub` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `aligne` int(11) NOT NULL,
  `agessivite` int(11) NOT NULL,
  `attitude` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `tactiqueclub`
--

INSERT INTO `tactiqueclub` (`id`, `idtactique`, `idclub`, `numero`, `aligne`, `agessivite`, `attitude`) VALUES
(1, 1, 6, 1, 0, 50, 50),
(2, 2, 6, 2, 0, 50, 50),
(3, 3, 6, 3, 1, 50, 50);

-- --------------------------------------------------------

--
-- Structure de la table `tactiquejoueur`
--

CREATE TABLE IF NOT EXISTS `tactiquejoueur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtactique` int(11) NOT NULL,
  `idjoueur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `tactiquejoueur`
--


-- --------------------------------------------------------

--
-- Structure de la table `transfert`
--

CREATE TABLE IF NOT EXISTS `transfert` (
  `idtransfert` int(11) NOT NULL AUTO_INCREMENT,
  `montant` int(11) NOT NULL,
  `idcvendeur` int(11) NOT NULL,
  `idcacheteur` int(11) NOT NULL,
  `idjoueur` int(11) NOT NULL,
  `accepte` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idtransfert`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `transfert`
--

INSERT INTO `transfert` (`idtransfert`, `montant`, `idcvendeur`, `idcacheteur`, `idjoueur`, `accepte`) VALUES
(6, 60000, 8, 6, 1, 1),
(5, 12000, 8, 6, 5, 1),
(14, 1000, 6, 8, 24, 1);

-- --------------------------------------------------------

--
-- Structure de la table `tv`
--

CREATE TABLE IF NOT EXISTS `tv` (
  `idtv` int(11) NOT NULL AUTO_INCREMENT,
  `idclub` int(11) NOT NULL,
  PRIMARY KEY (`idtv`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `tv`
--

INSERT INTO `tv` (`idtv`, `idclub`) VALUES
(1, 6),
(2, 8);

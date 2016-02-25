-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 25 Février 2016 à 18:37
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `webjuice`
--

-- --------------------------------------------------------

--
-- Structure de la table `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `area`
--

INSERT INTO `area` (`id`, `name`) VALUES
(1, 'Marketing');

-- --------------------------------------------------------

--
-- Structure de la table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `mail` varchar(128) NOT NULL,
  `password` varchar(64) NOT NULL,
  `country` enum('France','Irlande') NOT NULL,
  `city` varchar(64) NOT NULL,
  `desc` text NOT NULL,
  `website` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `company`
--

INSERT INTO `company` (`id`, `name`, `mail`, `password`, `country`, `city`, `desc`, `website`) VALUES
(1, 'BDifferent', 'hello@bdifferent.ie', 'ptut', 'Irlande', 'Dublin', 'Une agence de marketing digital. Oui oui, c''est une vraie !', 'http://www.bdifferent.ie/');

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `internship`
--

CREATE TABLE IF NOT EXISTS `internship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `desc` text NOT NULL,
  `company` int(11) NOT NULL,
  `way_num` int(128) NOT NULL,
  `way_type` varchar(64) NOT NULL,
  `way_name` varchar(64) NOT NULL,
  `city` varchar(128) NOT NULL,
  `zip_code` varchar(32) NOT NULL,
  `area` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `company` (`company`,`area`,`student`),
  KEY `area` (`area`),
  KEY `student` (`student`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `internship`
--

INSERT INTO `internship` (`id`, `name`, `desc`, `company`, `way_num`, `way_type`, `way_name`, `city`, `zip_code`, `area`, `student`) VALUES
(1, 'Community manager', 'Notre agence cherche un stagiaire pour remplir le rôle de community manager.', 1, 5, 'Avenue', 'Gowna Plaza', 'Dublin', '15', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `country` enum('France','Irlande') NOT NULL,
  `area` int(11) NOT NULL,
  `mail` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `cv` varchar(128) NOT NULL,
  `portfolio` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `area` (`area`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `student`
--

INSERT INTO `student` (`id`, `first_name`, `last_name`, `country`, `area`, `mail`, `password`, `cv`, `portfolio`) VALUES
(1, 'Valentin', 'Gougeon', 'France', 1, 'val.gougeon@hotmail.fr', 'ptut', '', '');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `internship`
--
ALTER TABLE `internship`
  ADD CONSTRAINT `internship_ibfk_1` FOREIGN KEY (`company`) REFERENCES `company` (`id`),
  ADD CONSTRAINT `internship_ibfk_2` FOREIGN KEY (`area`) REFERENCES `area` (`id`),
  ADD CONSTRAINT `internship_ibfk_3` FOREIGN KEY (`student`) REFERENCES `student` (`id`);

--
-- Contraintes pour la table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`area`) REFERENCES `area` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

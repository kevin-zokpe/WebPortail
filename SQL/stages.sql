-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 03 Mars 2016 à 15:20
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `stages`
--

-- --------------------------------------------------------

--
-- Structure de la table `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `area`
--

INSERT INTO `area` (`id`, `name`) VALUES
(1, 'Marketing'),
(2, 'Sport'),
(3, 'Commerce et Gestion'),
(4, 'Droit social'),
(5, 'Art et Design'),
(6, 'Santé'),
(7, 'Science Environnementale'),
(8, 'Développement Informatique'),
(9, 'Réseaux et Télécommunication'),
(10, 'Aérospatial / Aéronautique'),
(11, 'Mécanique et Électronique'),
(12, 'Architecture et Bâtiment'),
(13, 'Web et Communication'),
(14, 'Audiovisuel et Animation'),
(15, 'Énergie thermique et électrique');

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
  `address` varchar(128) NOT NULL,
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

INSERT INTO `internship` (`id`, `name`, `desc`, `company`, `address`, `city`, `zip_code`, `area`, `student`) VALUES
(1, 'Community manager', 'Notre agence cherche un stagiaire pour remplir le rôle de community manager.', 1, 'Gowna Plaza', 'Dublin', '15', 1, 1);

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
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `cv` varchar(128) NOT NULL,
  `portfolio` varchar(128) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `available` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `area` (`area`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `student`
--

INSERT INTO `student` (`id`, `first_name`, `last_name`, `country`, `skill`, `email`, `password`, `cv`, `portfolio`) VALUES
(1, 'Valentin', 'Gougeon', 'France', 1, 'val.gougeon@hotmail.fr', '$2y$12$CyMjfQyBElBAq0wxa3J3j.Txoxza/dwWS.C43RCzqSG7dDR.Qolvu', '', ''),
(2, 'Hadrien', 'Rannou', 'France', 1, 'hadriien@live.fr', '$2y$12$iG3tJq9C3iH1OzFqa2s0ruSa1zblb4XlF2Q0uZtvbW1KXy7KI/zW6', '', ''),
(3, 'Ange-Kévin', 'Zokpe', 'France', 2, 'kzokpe@gmail.com', '$2y$12$PHQVWOZuCfgK3h2tYpge0uAD3DNEh9GkKSCyn4iygS8fVY7Hbmtdy', '', '');

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

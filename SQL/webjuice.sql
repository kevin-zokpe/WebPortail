-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 08 Février 2016 à 22:59
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
-- Structure de la table `domaine`
--

CREATE TABLE IF NOT EXISTS `domaine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE IF NOT EXISTS `entreprise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  `mail` varchar(128) NOT NULL,
  `mdp` varchar(64) NOT NULL,
  `pays` enum('France','Irlande') NOT NULL,
  `ville` varchar(64) NOT NULL,
  `desc` text NOT NULL,
  `website` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE IF NOT EXISTS `etudiant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  `prenom` varchar(64) NOT NULL,
  `pays` enum('France','Irlande') NOT NULL,
  `domaine` int(11) NOT NULL,
  `mail` varchar(64) NOT NULL,
  `mdp` varchar(64) NOT NULL,
  `cv` varchar(128) NOT NULL,
  `portfolio` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `domaine` (`domaine`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `stage`
--

CREATE TABLE IF NOT EXISTS `stage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  `desc` text NOT NULL,
  `entreprise` int(11) NOT NULL,
  `domaine` int(11) NOT NULL,
  `etudiant` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `entreprise` (`entreprise`,`domaine`,`etudiant`),
  KEY `domaine` (`domaine`),
  KEY `etudiant` (`etudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_ibfk_1` FOREIGN KEY (`domaine`) REFERENCES `domaine` (`id`);

--
-- Contraintes pour la table `stage`
--
ALTER TABLE `stage`
  ADD CONSTRAINT `stage_ibfk_3` FOREIGN KEY (`etudiant`) REFERENCES `etudiant` (`id`),
  ADD CONSTRAINT `stage_ibfk_1` FOREIGN KEY (`entreprise`) REFERENCES `entreprise` (`id`),
  ADD CONSTRAINT `stage_ibfk_2` FOREIGN KEY (`domaine`) REFERENCES `domaine` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

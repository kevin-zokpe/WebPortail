-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Jeu 25 Février 2016 à 19:29
-- Version du serveur :  5.5.42
-- Version de PHP :  7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `stages`
--

-- --------------------------------------------------------

--
-- Structure de la table `internship`
--

CREATE TABLE `internship` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `company` int(11) NOT NULL,
  `way_num` int(128) NOT NULL,
  `way_type` varchar(64) NOT NULL,
  `way_name` varchar(64) NOT NULL,
  `city` varchar(128) NOT NULL,
  `zip_code` varchar(32) NOT NULL,
  `area` int(11) NOT NULL,
  `student` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `internship`
--

INSERT INTO `internship` (`id`, `name`, `description`, `company`, `way_num`, `way_type`, `way_name`, `city`, `zip_code`, `area`, `student`) VALUES
(1, 'Community manager', 'Notre agence cherche un stagiaire pour remplir le rôle de community manager.', 1, 5, 'Avenue', 'Gowna Plaza', 'Dublin', '15', 1, 1),
(3, 'Développeur Symfony2', 'Afin d''améliorer le site et son fonctionnement, nous recherchons un stagiaire capable de migrer notre site actuel vers le framework Symfony2.', 2, 16, 'Rue', 'Jean Monnet', 'Rennes', '35200', 2, 2);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `internship`
--
ALTER TABLE `internship`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company` (`company`,`area`,`student`),
  ADD KEY `area` (`area`),
  ADD KEY `student` (`student`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `internship`
--
ALTER TABLE `internship`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
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

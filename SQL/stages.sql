-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Jeu 03 Mars 2016 à 16:09
-- Version du serveur :  5.5.38
-- Version de PHP :  5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `stages`
--

-- --------------------------------------------------------

--
-- Structure de la table `company`
--

CREATE TABLE `company` (
`id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(64) NOT NULL,
  `country` enum('France','Irlande') NOT NULL,
  `city` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `website` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `company`
--

INSERT INTO `company` (`id`, `name`, `email`, `password`, `country`, `city`, `description`, `website`) VALUES
(1, 'BDifferent', 'hello@bdifferent.ie', '$2y$12$6FBWV3.XhBB5vc7.1HayAunpLopRdrJJQbAEIcDLDvU/TOd4MJaGm', 'Irlande', 'Dublin', 'Une agence de marketing digital. Oui oui, c''est une vraie !', 'http://www.bdifferent.ie/'),
(2, 'Hadrien Design', 'support@hadriendesign.com', '$2y$12$qfiWQpEP8UAwoSyZIMxnzeDCI6f5KVJVoReUuh8Al/YKZ2RZ81s2q', 'France', 'Rennes', 'Hadrien Design est une entreprise qui se charge de regrouper des développeurs et designers pour mettre en commun leur expérience.', 'https://hadriendesign.com/');

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
  `skill` int(11) NOT NULL,
  `student` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `internship`
--

INSERT INTO `internship` (`id`, `name`, `description`, `company`, `way_num`, `way_type`, `way_name`, `city`, `zip_code`, `skill`, `student`) VALUES
(1, 'Community manager', 'Notre agence cherche un stagiaire pour remplir le rôle de community manager.', 1, 5, 'Avenue', 'Gowna Plaza', 'Dublin', '15', 1, 1),
(3, 'Développeur Symfony2', 'Afin d''améliorer le site et son fonctionnement, nous recherchons un stagiaire capable de migrer notre site actuel vers le framework Symfony2.', 2, 16, 'Rue', 'Jean Monnet', 'Rennes', '35200', 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `skill`
--

CREATE TABLE `skill` (
`id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `skill`
--

INSERT INTO `skill` (`id`, `name`) VALUES
(1, 'Marketing'),
(2, 'Programmation');

-- --------------------------------------------------------

--
-- Structure de la table `student`
--

CREATE TABLE `student` (
`id` int(11) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `country` enum('France','Irlande') NOT NULL,
  `skill` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `cv` varchar(128) NOT NULL,
  `portfolio` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `student`
--

INSERT INTO `student` (`id`, `first_name`, `last_name`, `country`, `skill`, `email`, `password`, `cv`, `portfolio`) VALUES
(1, 'Valentin', 'Gougeon', 'France', 1, 'val.gougeon@hotmail.fr', '$2y$12$CyMjfQyBElBAq0wxa3J3j.Txoxza/dwWS.C43RCzqSG7dDR.Qolvu', '', ''),
(2, 'Hadrien', 'Rannou', 'France', 1, 'hadriien@live.fr', '$2y$12$iG3tJq9C3iH1OzFqa2s0ruSa1zblb4XlF2Q0uZtvbW1KXy7KI/zW6', '', ''),
(3, 'Ange-Kévin', 'Zokpe', 'France', 2, 'kzokpe@gmail.com', '$2y$12$PHQVWOZuCfgK3h2tYpge0uAD3DNEh9GkKSCyn4iygS8fVY7Hbmtdy', '', '');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `company`
--
ALTER TABLE `company`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `internship`
--
ALTER TABLE `internship`
 ADD PRIMARY KEY (`id`), ADD KEY `company` (`company`,`skill`,`student`), ADD KEY `skill` (`skill`), ADD KEY `student` (`student`);

--
-- Index pour la table `skill`
--
ALTER TABLE `skill`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `student`
--
ALTER TABLE `student`
 ADD PRIMARY KEY (`id`), ADD KEY `skill` (`skill`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `company`
--
ALTER TABLE `company`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `internship`
--
ALTER TABLE `internship`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `skill`
--
ALTER TABLE `skill`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `student`
--
ALTER TABLE `student`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `internship`
--
ALTER TABLE `internship`
ADD CONSTRAINT `internship_ibfk_1` FOREIGN KEY (`company`) REFERENCES `company` (`id`),
ADD CONSTRAINT `internship_ibfk_2` FOREIGN KEY (`skill`) REFERENCES `skill` (`id`),
ADD CONSTRAINT `internship_ibfk_3` FOREIGN KEY (`student`) REFERENCES `student` (`id`);

--
-- Contraintes pour la table `student`
--
ALTER TABLE `student`
ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`skill`) REFERENCES `skill` (`id`);

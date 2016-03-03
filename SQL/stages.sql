-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Jeu 03 Mars 2016 à 16:32
-- Version du serveur :  5.5.38
-- Version de PHP :  5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `stages`
--

-- --------------------------------------------------------

--
-- Structure de la table `student`
--

CREATE TABLE `student` (
`id` int(11) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `country` enum('France','Irlande') NOT NULL,
  `area` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `cv` varchar(128) NOT NULL,
  `portfolio` varchar(128) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `available` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `student`
--

INSERT INTO `student` (`id`, `first_name`, `last_name`, `country`, `area`, `email`, `password`, `cv`, `portfolio`, `admin`, `available`) VALUES
(1, 'Valentin', 'Gougeon', 'France', 1, 'val.gougeon@hotmail.fr', 'ptut', '', '', 0, 1),
(2, 'Ange Kevin', 'Zokpe', 'France', 3, 'kzokpe@gmail.com', '$2y$12$PHQVWOZuCfgK3h2tYpge0uAD3DNEh9GkKSCyn4iygS8fVY7Hbmtdy', '', '', 0, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `student`
--
ALTER TABLE `student`
 ADD PRIMARY KEY (`id`), ADD KEY `area` (`area`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `student`
--
ALTER TABLE `student`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `student`
--
ALTER TABLE `student`
ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`area`) REFERENCES `area` (`id`);

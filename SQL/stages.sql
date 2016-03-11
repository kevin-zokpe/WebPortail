-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 11 Mars 2016 à 20:47
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
-- Structure de la table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(64) NOT NULL,
  `country` enum('France','Irlande') NOT NULL,
  `city` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `website` varchar(64) NOT NULL,
  `activated` tinyint(1) NOT NULL,
  `register_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `company`
--

INSERT INTO `company` (`id`, `name`, `email`, `password`, `country`, `city`, `description`, `website`, `activated`, `register_date`) VALUES
(1, 'BDifferent', 'hello@bdifferent.ie', '$2y$12$IXNKWxY7WyWyWRfIRxfyKOtkOz41PJA1uxXSIDKLmljd5S3om4P1G', 'Irlande', 'Dublin', 'Une agence de marketing digital. Oui oui, c''est une vraie !', 'http://www.bdifferent.ie/', 1, '2016-03-01'),
(2, 'Hadrien Design', 'support@hadriendesign.com', '$2y$12$qfiWQpEP8UAwoSyZIMxnzeDCI6f5KVJVoReUuh8Al/YKZ2RZ81s2q', 'France', 'Rennes', 'Hadrien Design est une entreprise qui se charge de regrouper des développeurs et designers pour mettre en commun leur expérience.', 'https://hadriendesign.com/', 1, '2016-03-03'),
(3, 'Quinze-Mille', 'studio@quinze-mille.com', '$2y$12$fUEX85oTdDiH.Jo9V6cjM.9O1/NE55/YsmPifuHdBXqkKiSUogsHO', 'France', 'Rennes', 'Studio graphique et plus encore. Les plus, ce sont l’oxygène breton, le mix de sept cerveaux gauche et droit, des nez au vent et dans le guidon, des chats et des souris, du talent et du travail. Et la recette fonctionne depuis 2000.', 'http://www.quinze-mille.com/', 0, '2016-03-08');

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `target` enum('student','company') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`, `target`) VALUES
(1, 'Pourquoi prendre un stagiaire d’un pays étranger ? ', 'Donner une image dynamique à votre entreprise et bénéficier d’un savoir-faire extérieur pour apporter du frais dans l’entreprise.', 'company'),
(2, 'Devrez-vous rémunérer l’étudiant ?', 'La rémunération dépend du pays dans lequel vous effectuerez votre stage. Les stages sont rémunérés en a un minimum 540 à condition que le stage est une durée de 10 semaines.', 'company'),
(3, 'Pourquoi utiliser notre portail de stage ? ', 'Nous vous offrons une plateforme qui vous permettra de trouver des étudiants sérieux et prêts à réaliser des projets innovants. Notre portail vous permettra de proposer vos offres de stage en toutes sécurités et bien entendu vous serrez sûr d’assurer d’atteindre les bonnes cibles.', 'company'),
(4, 'À qui poser des questions plus précises ?', 'Vous pouvez contacter M. Clouet Jérôme, professeur d’anglais a l’IUT de Saint-Lô qui a été l’initiateur de ce projet. Il prendra plaisir à répondre à toutes vos questions. Vous pouvez le contacter à l’adresse suivante : JérômeClouet @unicaen.fr', 'company'),
(5, 'Pourquoi effectuer son stage à l’étranger ?', 'De nos jours les stages à l’étranger sont très appréciés par les entreprises. Effectuer votre stage dans un pays étranger vous permettra ainsi de valoriser votre CV tout en vous permettant de découvrir une nouvelle culture', 'student'),
(6, 'Comment contacter facilement une entreprise en Irlande ?', 'Notre portail web est la solution ! Si toi aussi tu as envie de faire parti de l’aventure il te suffit de créer un compte et déposer ton CV et ta lettre de motivation pour avoir accès à plusieurs stages étrangers. ', 'student'),
(7, 'Vais-je percevoir des bourses durant mon séjour ?', 'Les bourses dépendent du pays dans lequel tu te trouves, nous t’invitons à prendre contact avec le représentant de ton école pour avoir plus de modalités sur les différents moyens d’obtenir des bourses', 'student'),
(8, 'Ou vais-je séjourner durant mon stage ? ', 'Plusieurs moyens d’hébergements existent. Selon ton profil les entreprises peuvent te proposer des logements proches de ton futur lieu de travail. Ce qui te permettra de travailler sans te soucier du mauvais temps qu’il fait dehors par exemple', 'student'),
(9, 'Ou puis-je trouver plus de témoignages et de bonnes adresses ? ', 'Des élèves ayant effectué leurs stages à l’étranger remplissent des fiches à leur retour nous t’invitons à te renseigner auprès de ton école pour bénéficier de ses fiches de témoignages et t’imprégner de leurs expériences', 'student'),
(11, 'Qui êtes-vous ?', 'Apple', 'company');

-- --------------------------------------------------------

--
-- Structure de la table `internship`
--

CREATE TABLE IF NOT EXISTS `internship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `company` int(11) NOT NULL,
  `address` varchar(128) NOT NULL,
  `city` varchar(128) NOT NULL,
  `zip_code` varchar(32) NOT NULL,
  `skill` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `internship`
--

INSERT INTO `internship` (`id`, `name`, `description`, `company`, `address`, `city`, `zip_code`, `skill`) VALUES
(1, 'Community Manager', 'Test', 1, '12 Wood Quay', 'Dublin', '15', 13),
(2, 'Codeur Laravel', 'Nous recherchons un codeur Laravel pour migrer notre site actuel vers Laravel 5.', 2, '15 rue des Trentes', 'Rennes', '35000', 8);

-- --------------------------------------------------------

--
-- Structure de la table `partner`
--

CREATE TABLE IF NOT EXISTS `partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `logo` varchar(128) CHARACTER SET utf8 NOT NULL,
  `country` enum('France','Irlande') CHARACTER SET utf8 NOT NULL,
  `register_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `partner`
--

INSERT INTO `partner` (`id`, `name`, `logo`, `country`, `register_date`) VALUES
(1, 'IUT Cherbourg-Manche', '', 'France', '2016-03-11'),
(3, 'LetterKenny IT', '', 'Irlande', '2016-03-11');

-- --------------------------------------------------------

--
-- Structure de la table `skill`
--

CREATE TABLE IF NOT EXISTS `skill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `skill`
--

INSERT INTO `skill` (`id`, `name`) VALUES
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
-- Structure de la table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `country` enum('France','Irlande') NOT NULL,
  `skill` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `cv` varchar(128) NOT NULL,
  `portfolio` varchar(128) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `available` tinyint(1) NOT NULL DEFAULT '1',
  `activated` tinyint(1) NOT NULL,
  `register_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `skill` (`skill`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `student`
--

INSERT INTO `student` (`id`, `first_name`, `last_name`, `country`, `skill`, `email`, `password`, `cv`, `portfolio`, `admin`, `available`, `activated`, `register_date`) VALUES
(1, 'Valentin', 'Gougeon', 'France', 1, 'val.gougeon@hotmail.fr', '$2y$12$cnad250ZDSyikBC6anzZ5.BjprYibKhYkEjPfZ1bVPzarrTvcYQbi', '', 'http://youtube.com', 1, 1, 1, '2016-02-18'),
(2, 'Hadrien', 'Rannou', 'France', 1, 'hadriien@live.fr', '$2y$12$iG3tJq9C3iH1OzFqa2s0ruSa1zblb4XlF2Q0uZtvbW1KXy7KI/zW6', '', 'http://hadrien.info/portfolio/', 1, 1, 1, '2016-02-20'),
(3, 'Ange Kevin', 'Zokpe', 'France', 13, 'kzokpe@gmail.com', '$2y$12$svwYSh7MopBR0UIc9rSuWuS2qnVQ5Wa/6Cntlofw3SPYTRgE/0Y0e', '', 'https://akdesign.com', 1, 1, 1, '2016-03-08');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`skill`) REFERENCES `skill` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

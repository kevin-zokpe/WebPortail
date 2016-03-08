-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Sam 05 Mars 2016 à 15:13
-- Version du serveur :  5.5.42
-- Version de PHP :  7.0.0

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
  `website` varchar(64) NOT NULL,
  `activated` tinyint(1) NOT NULL,
  `register_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `company`
--

INSERT INTO `company` (`id`, `name`, `email`, `password`, `country`, `city`, `description`, `website`, `activated`, `register_date`) VALUES
(1, 'BDifferent', 'hello@bdifferent.ie', '$2y$12$IXNKWxY7WyWyWRfIRxfyKOtkOz41PJA1uxXSIDKLmljd5S3om4P1G', 'Irlande', 'Dublin', 'Une agence de marketing digital. Oui oui, c''est une vraie !', 'http://www.bdifferent.ie/', 1, '0000-00-00'),
(2, 'Hadrien Design', 'support@hadriendesign.com', '$2y$12$qfiWQpEP8UAwoSyZIMxnzeDCI6f5KVJVoReUuh8Al/YKZ2RZ81s2q', 'France', 'Rennes', 'Hadrien Design est une entreprise qui se charge de regrouper des développeurs et designers pour mettre en commun leur expérience.', 'https://hadriendesign.com/', 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `target` enum('student','company') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

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
(10, 'Quel niveau de langue dois-je avoir pour partir à l’étranger ?', 'Un niveau professionnel est exigé pour effectuer un stage à l’étranger. Aucun employé ne souhaite se retrouver avec un stagiaire, certes performants mais qui ne comprend pas ce qu’on lui demande !', 'student');

-- --------------------------------------------------------

--
-- Structure de la table `internship`
--

CREATE TABLE `internship` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `desc` text NOT NULL,
  `company` int(11) NOT NULL,
  `address` varchar(128) NOT NULL,
  `city` varchar(128) NOT NULL,
  `zip_code` varchar(32) NOT NULL,
  `skill` int(11) NOT NULL,
  `student` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `internship`
--

INSERT INTO `internship` (`id`, `name`, `desc`, `company`, `address`, `city`, `zip_code`, `skill`, `student`) VALUES
(1, 'Community manager', 'Notre agence cherche un stagiaire pour remplir le rôle de community manager.', 1, 'Gowna Plaza', 'Dublin', '15', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `skill`
--

CREATE TABLE `skill` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

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

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
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
  `register_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `student`
--

INSERT INTO `student` (`id`, `first_name`, `last_name`, `country`, `skill`, `email`, `password`, `cv`, `portfolio`, `admin`, `available`, `activated`, `register_date`) VALUES
(1, 'Valentin', 'Gougeon', 'France', 1, 'val.gougeon@hotmail.fr', '$2y$12$cnad250ZDSyikBC6anzZ5.BjprYibKhYkEjPfZ1bVPzarrTvcYQbi', '', 'http://youtube.com', 0, 0, 1, '0000-00-00'),
(2, 'Hadrien', 'Rannou', 'France', 1, 'hadriien@live.fr', '$2y$12$iG3tJq9C3iH1OzFqa2s0ruSa1zblb4XlF2Q0uZtvbW1KXy7KI/zW6', '', 'http://hadrien.info/portfolio/', 1, 1, 1, '0000-00-00'),
(3, 'Ange Kevin', 'Zokpe', 'France', 13, 'kzokpe@gmail.com', '$2y$12$svwYSh7MopBR0UIc9rSuWuS2qnVQ5Wa/6Cntlofw3SPYTRgE/0Y0e', '', 'https://akdesign.com', 1, 1, 1, '2016-03-08');


--
-- Index pour les tables exportées
--

--
-- Index pour la table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `internship`
--
ALTER TABLE `internship`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company` (`company`,`skill`,`student`),
  ADD KEY `skill` (`skill`),
  ADD KEY `student` (`student`);

--
-- Index pour la table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skill` (`skill`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `internship`
--
ALTER TABLE `internship`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `skill`
--
ALTER TABLE `skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
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

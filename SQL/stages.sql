-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 23 Mars 2016 à 01:36
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
  `logo` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `website` varchar(64) NOT NULL,
  `activated` tinyint(1) NOT NULL,
  `register_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `company`
--

INSERT INTO `company` (`id`, `name`, `email`, `password`, `country`, `city`, `logo`, `description`, `website`, `activated`, `register_date`) VALUES
(1, 'BDifferent', 'hello@bdifferent.ie', '$2y$12$IXNKWxY7WyWyWRfIRxfyKOtkOz41PJA1uxXSIDKLmljd5S3om4P1G', 'Irlande', 'Dublin', '', 'Une agence de marketing digital. Oui oui, c''est une vraie !', 'http://www.bdifferent.ie/', 1, '2016-03-01'),
(2, 'Hadrien Design', 'support@hadriendesign.com', '$2y$12$qfiWQpEP8UAwoSyZIMxnzeDCI6f5KVJVoReUuh8Al/YKZ2RZ81s2q', 'France', 'Rennes', '', 'Hadrien Design est une entreprise qui se charge de regrouper des développeurs et designers pour mettre en commun leur expérience.', 'https://hadriendesign.com/', 1, '2016-03-03'),
(3, 'Quinze-Mille', 'studio@quinze-mille.com', '$2y$12$fUEX85oTdDiH.Jo9V6cjM.9O1/NE55/YsmPifuHdBXqkKiSUogsHO', 'France', 'Rennes', '', 'Studio graphique et plus encore. Les plus, ce sont l’oxygène breton, le mix de sept cerveaux gauche et droit, des nez au vent et dans le guidon, des chats et des souris, du talent et du travail. Et la recette fonctionne depuis 2000.', 'http://www.quinze-mille.com/', 1, '2016-03-08'),
(5, 'Liddl', 'liddl@contact.com', '$2y$12$xKiE2w1G68Oj10PUORJUb.uvqOA68YnPGCF/UKpq20xvedkDg9iCe', 'Irlande', 'Saint-Lô', 'uploads/companies/5.jpg', 'blabla', 'http://www.mycompany.com', 1, '2016-03-16');

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_fr` text NOT NULL,
  `answer_fr` text NOT NULL,
  `question_en` text NOT NULL,
  `answer_en` text NOT NULL,
  `target` enum('student','company') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `faq`
--

INSERT INTO `faq` (`id`, `question_fr`, `answer_fr`, `question_en`, `answer_en`, `target`) VALUES
(1, 'Pourquoi prendre un stagiaire d’un pays étranger ? ', 'Donner une image dynamique à votre entreprise et bénéficier d’un savoir-faire extérieur pour apporter du frais dans l’entreprise.', 'Why would you take an foreign intern ?', 'It''ll give an dynamic look to your company and you''ll benefit from outside expertise. This will give a refreshing image!', 'company'),
(2, 'Devrez-vous rémunérer l’étudiant ?', 'La rémunération dépend du pays dans lequel vous effectuerez votre stage. Les stages sont rémunérés en a un minimum 540 à condition que le stage est une durée de 10 semaines.', 'Do you have to pay the intern ?', 'The pay depends on the country where the intern passes his internship. In France, the internship is payed at least 540 per month on condition that it lasts 10 weeks.', 'company'),
(3, 'Pourquoi utiliser notre portail de stage ? ', 'Nous vous offrons une plateforme qui vous permettra de trouver des étudiants sérieux et prêts à réaliser des projets innovants. Notre portail vous permettra de proposer vos offres de stage en toutes sécurités et bien entendu vous serrez sûr d’assurer d’atteindre les bonnes cibles.', 'Why use our internship webportal ?', 'We offer you a platform that''ll help you to find serious students, ready to realise innovating projects. Our webportal will allow you put your internship offers, in complete safety, and so you''ll be sure to reach the right people.', 'company'),
(4, 'À qui poser des questions plus précises ?', 'Vous pouvez contacter M. Clouet Jérôme, professeur d’anglais a l’IUT de Saint-Lô qui a été l’initiateur de ce projet. Il prendra plaisir à répondre à toutes vos questions. Vous pouvez le contacter à l’adresse suivante : JérômeClouet @unicaen.fr', 'To who ask some precise questions ?', 'You can contact M. Clouet Jérôme, english teacher at IUT Saint-Lô, who also was the pioneer of this project. He would answer all of your questions with pleasure. You can contact him at the following email: jerome.clouet@unicaen.fr', 'company'),
(5, 'Pourquoi effectuer son stage à l’étranger ?', 'De nos jours les stages à l’étranger sont très appréciés par les entreprises. Effectuer votre stage dans un pays étranger vous permettra ainsi de valoriser votre CV tout en vous permettant de découvrir une nouvelle culture', 'Why do my internship abroad ?', 'Nowadays internships abroad are very appreciated by companies. To intern abroad will help you to develop your CV while allowing you to discover a new culture.', 'student'),
(6, 'Comment contacter facilement une entreprise en Irlande ?', 'Notre portail web est la solution ! Si toi aussi tu as envie de faire parti de l’aventure il te suffit de créer un compte et déposer ton CV et ta lettre de motivation pour avoir accès à plusieurs stages étrangers. ', 'How to easily contact a company in France ?', 'Our webportal is the solution! If you too you want to be part of the adventure, all you need to do is to create an account and to deposit your CV so you can acces the different interships abroad.', 'student'),
(7, 'Vais-je percevoir des bourses durant mon séjour ?', 'Les bourses dépendent du pays dans lequel tu te trouves, nous t’invitons à prendre contact avec le représentant de ton école pour avoir plus de modalités sur les différents moyens d’obtenir des bourses', 'Will I get my scholarships during my stay ?', 'The scholarships depend on the country where you live. We invite you to contact the representative at your school for more information on how to get you scholarships', 'student'),
(8, 'Ou vais-je séjourner durant mon stage ? ', 'Plusieurs moyens d’hébergements existent. Selon ton profil les entreprises peuvent te proposer des logements proches de ton futur lieu de travail. Ce qui te permettra de travailler sans te soucier du mauvais temps qu’il fait dehors par exemple', 'Where will I stay during my internship ?', 'Several means of housing exist. According to your profile, the companies can offer you housing close to your futur workplace. That''ll  allow you to work without worrying about bad weather for example.', 'student'),
(9, 'Ou puis-je trouver plus de témoignages et de bonnes adresses ?', 'Des élèves ayant effectué leurs stages à l’étranger remplissent des fiches à leur retour nous t’invitons à te renseigner auprès de ton école pour bénéficier de ses fiches de témoignages et t’imprégner de leurs expériences', 'Where can I find more testimonials and good adresses ?', 'Students that have done their internships abroad will complete some files at their return. We invite you to inform you at your school to benefit from these files and to learn from this experience. Otherwise, we''ll have some testimonials on our website that you can read.', 'student');

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
  `country` enum('France','Irlande') NOT NULL,
  `skill` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `internship`
--

INSERT INTO `internship` (`id`, `name`, `description`, `company`, `address`, `city`, `zip_code`, `country`, `skill`) VALUES
(1, 'Community Manager', 'Test', 1, '12 Wood Quay', 'Dublin', '15', 'Irlande', 13),
(2, 'Codeur Laravel', 'Nous recherchons un codeur Laravel pour migrer notre site actuel vers Laravel 5.', 2, '15 rue des Trentes', 'Rennes', '35000', 'France', 8);

-- --------------------------------------------------------

--
-- Structure de la table `partner`
--

CREATE TABLE IF NOT EXISTS `partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `logo` varchar(128) CHARACTER SET utf8 NOT NULL,
  `country` enum('France','Irlande') CHARACTER SET utf8 NOT NULL,
  `type` enum('company','university') NOT NULL DEFAULT 'company',
  `register_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `partner`
--

INSERT INTO `partner` (`id`, `name`, `logo`, `country`, `type`, `register_date`) VALUES
(1, 'IUT Cherbourg-Manche', 'uploads/partners/1.png', 'France', 'university', '2016-03-11'),
(2, 'Conseil général de la Manche', 'uploads/partners/2.png', 'France', 'company', '2016-03-20');

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(64) NOT NULL,
  `value` varchar(256) NOT NULL,
  `placeholder` varchar(128) NOT NULL,
  `data_type` enum('varchar','int','boolean') NOT NULL DEFAULT 'varchar',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `settings`
--

INSERT INTO `settings` (`id`, `tag`, `value`, `placeholder`, `data_type`) VALUES
(1, 'website_name', 'Web Portal', 'Titre du site', 'varchar'),
(2, 'website_description', 'Lorem ipsum dolor sit amet', 'Description du site', 'varchar'),
(3, 'notification_email', 'hadriien@live.fr', 'Email recevant les notifications', 'varchar'),
(4, 'activate_notification', 'true', 'Activer les notifications', 'boolean'),
(5, 'recaptcha_public_key', '6Lc2cBoTAAAAAF9TTSA9CRMbg-jss8X-CmDy_eXI', 'Clé publique Recaptcha', 'varchar'),
(6, 'recaptcha_private_key', '6Lc2cBoTAAAAAFUipDOigbn4PrJIScG6bwUqWbTQ', 'Clé privée Recaptcha', 'varchar');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `student`
--

INSERT INTO `student` (`id`, `first_name`, `last_name`, `country`, `skill`, `email`, `password`, `cv`, `portfolio`, `admin`, `available`, `activated`, `register_date`) VALUES
(1, 'Valentin', 'Gougeon', 'France', 1, 'val.gougeon@hotmail.fr', '$2y$12$cnad250ZDSyikBC6anzZ5.BjprYibKhYkEjPfZ1bVPzarrTvcYQbi', '', 'http://youtube.com', 1, 1, 1, '2016-02-18'),
(2, 'Hadrien', 'Rannou', 'France', 1, 'hadriien@live.fr', '$2y$12$iG3tJq9C3iH1OzFqa2s0ruSa1zblb4XlF2Q0uZtvbW1KXy7KI/zW6', '', 'http://hadrien.info/portfolio/', 1, 1, 1, '2016-02-20'),
(3, 'Ange Kevin', 'Zokpe', 'France', 13, 'kzokpe@gmail.com', '$2y$12$svwYSh7MopBR0UIc9rSuWuS2qnVQ5Wa/6Cntlofw3SPYTRgE/0Y0e', '', 'https://akdesign.com', 1, 1, 1, '2016-03-08'),
(6, 'Test', 'Test', 'Irlande', 1, 'test@test.fr', '$2y$12$svwYSh7MopBR0UIc9rSuWuS2qnVQ5Wa/6Cntlofw3SPYTRgE/0Y0e', '', '', 0, 1, 1, '2016-03-19');

-- --------------------------------------------------------

--
-- Structure de la table `testimony`
--

CREATE TABLE IF NOT EXISTS `testimony` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text CHARACTER SET utf8 NOT NULL,
  `author` varchar(64) CHARACTER SET utf8 NOT NULL,
  `register_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student` (`author`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `testimony`
--

INSERT INTO `testimony` (`id`, `description`, `author`, `register_date`) VALUES
(2, 'C''était trop cool ! Génial !', 'Valentin Gougeon', '2016-03-12'),
(4, 'Hello world!', 'Hadrien', '2016-03-18');

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

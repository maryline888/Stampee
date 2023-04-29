-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : sam. 29 avr. 2023 à 00:45
-- Version du serveur :  5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `stampee`
--

-- --------------------------------------------------------

--
-- Structure de la table `ENCHERE`
--

CREATE TABLE `ENCHERE` (
  `enchere_id` smallint(5) UNSIGNED NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `prix_plancher` decimal(19,2) NOT NULL,
  `coup_de_coeur_lord` tinyint(1) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT NULL,
  `utilisateur_id` smallint(5) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ENCHERE`
--

INSERT INTO `ENCHERE` (`enchere_id`, `date_debut`, `date_fin`, `prix_plancher`, `coup_de_coeur_lord`, `archive`, `utilisateur_id`) VALUES
(62, '2023-04-27', '2023-05-07', '9.99', 0, NULL, 7),
(63, '2023-04-27', '2023-05-13', '12.22', 0, NULL, 7),
(64, '2023-04-27', '2023-05-02', '123.23', 0, NULL, 7),
(65, '2023-04-27', '2023-05-07', '98.90', 1, NULL, 7),
(66, '2023-04-27', '2023-04-29', '1.90', 0, NULL, 8),
(67, '2023-04-27', '2023-05-07', '12.22', 0, NULL, 8),
(68, '2023-04-27', '2023-05-07', '12.80', 0, NULL, 8),
(69, '2023-04-27', '2023-05-07', '1000.00', 1, NULL, 9),
(70, '2023-04-27', '2023-05-07', '12.80', 0, NULL, 9),
(71, '2023-04-28', '2023-05-07', '9.99', 0, NULL, 10),
(72, '2023-04-28', '2023-05-06', '12.22', 0, NULL, 9),
(73, '2023-04-28', '2023-05-07', '123.90', 0, NULL, 1),
(74, '2023-04-30', '2023-05-05', '222.00', 0, NULL, 9);

-- --------------------------------------------------------

--
-- Structure de la table `FAVORIS`
--

CREATE TABLE `FAVORIS` (
  `utilisateur_id` smallint(5) UNSIGNED NOT NULL,
  `enchere_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `IMAGE`
--

CREATE TABLE `IMAGE` (
  `image_id` smallint(5) UNSIGNED NOT NULL,
  `image_url` varchar(100) DEFAULT NULL,
  `timbre_id` smallint(5) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `IMAGE`
--

INSERT INTO `IMAGE` (`image_id`, `image_url`, `timbre_id`) VALUES
(46, './uploads/644a98e03a446.webp', 62),
(47, './uploads/644a990aa17d9.webp', 63),
(48, './uploads/644a995bd5709.webp', 64),
(49, './uploads/644a9995619f8.webp', NULL),
(50, './uploads/644a99bad02f9.webp', 65),
(51, './uploads/644a9a675de7b.webp', 67),
(52, './uploads/644a9a90037fc.webp', 68),
(53, './uploads/644ab0913aa47.webp', 69),
(54, './uploads/644b440907b40.webp', 70),
(55, './uploads/644bc4e1ca5fc.webp', 71),
(56, './uploads/644bdef404adf.webp', 72),
(57, './uploads/644c39a2c4ceb.webp', 73),
(58, './uploads/644c4c5c20681.webp', NULL),
(59, './uploads/644c517249e41.webp', NULL),
(60, './uploads/644c67661ba4b.webp', 74);

-- --------------------------------------------------------

--
-- Structure de la table `MISE`
--

CREATE TABLE `MISE` (
  `mise_id` int(10) UNSIGNED NOT NULL,
  `utilisateur_id` smallint(5) UNSIGNED NOT NULL,
  `enchere_id` smallint(5) UNSIGNED NOT NULL,
  `montant` decimal(19,2) NOT NULL,
  `date_mise` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `MISE`
--

INSERT INTO `MISE` (`mise_id`, `utilisateur_id`, `enchere_id`, `montant`, `date_mise`) VALUES
(1, 1, 68, '14.00', '2023-04-28 06:30:53'),
(2, 1, 68, '18.00', '2023-04-28 06:31:27'),
(3, 1, 67, '10.00', '2023-04-28 06:33:36'),
(4, 1, 65, '23.00', '2023-04-28 06:35:12'),
(10, 1, 62, '12.00', '2023-04-28 06:50:09'),
(11, 1, 67, '14.00', '2023-04-28 06:58:31'),
(12, 1, 65, '115.88', '2023-04-28 07:07:23'),
(13, 1, 69, '1005.23', '2023-04-28 07:10:05'),
(14, 1, 63, '13.85', '2023-04-28 07:22:38'),
(15, 1, 63, '18.98', '2023-04-28 07:23:30'),
(16, 1, 64, '125.00', '2023-04-28 07:32:50'),
(17, 1, 65, '450.45', '2023-04-28 07:34:16'),
(18, 1, 65, '520.00', '2023-04-28 07:35:47'),
(19, 9, 64, '23000.00', '2023-04-28 07:40:45'),
(20, 9, 62, '15.00', '2023-04-28 07:58:17'),
(21, 9, 67, '258.00', '2023-04-28 08:02:23'),
(22, 9, 62, '85.00', '2023-04-28 08:02:30'),
(23, 9, 62, '520.09', '2023-04-28 08:12:27'),
(24, 9, 65, '582.00', '2023-04-28 08:13:29'),
(25, 1, 70, '15.99', '2023-04-28 16:43:43'),
(26, 10, 70, '46.00', '2023-04-28 17:19:32'),
(27, 9, 71, '8.00', '2023-04-28 18:56:45'),
(28, 9, 68, '200.00', '2023-04-28 18:57:09'),
(29, 1, 69, '2349.00', '2023-04-28 21:46:24'),
(30, 1, 69, '5000.00', '2023-04-28 21:46:35'),
(31, 1, 71, '23.00', '2023-04-29 04:30:14'),
(32, 9, 71, '3456.00', '2023-04-29 04:40:36');

-- --------------------------------------------------------

--
-- Structure de la table `ROLE`
--

CREATE TABLE `ROLE` (
  `role_id` smallint(5) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ROLE`
--

INSERT INTO `ROLE` (`role_id`, `nom`) VALUES
(1, 'administrateur'),
(2, 'membre');

-- --------------------------------------------------------

--
-- Structure de la table `TIMBRE`
--

CREATE TABLE `TIMBRE` (
  `timbre_id` smallint(5) UNSIGNED NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `date_creation` date NOT NULL,
  `couleur` varchar(20) NOT NULL,
  `pays_origine` varchar(50) NOT NULL,
  `tirage` varchar(50) DEFAULT NULL,
  `dimensions` varchar(50) DEFAULT NULL,
  `certifie` tinyint(1) NOT NULL,
  `utilisateur` smallint(5) UNSIGNED DEFAULT NULL,
  `enchere_id` smallint(5) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `TIMBRE`
--

INSERT INTO `TIMBRE` (`timbre_id`, `nom`, `date_creation`, `couleur`, `pays_origine`, `tirage`, `dimensions`, `certifie`, `utilisateur`, `enchere_id`) VALUES
(62, '98k09k', '1950-01-01', 'rouge', 'canada', '', '', 0, 7, 62),
(63, '78gt654321', '1919-01-01', 'bleu', 'france', '', '', 0, 7, 63),
(64, '12393030303', '1989-01-01', 'vert', 'espagne', '', '', 0, 7, 64),
(65, '09oip', '2015-01-01', 'rouge', 'canada', '', '', 0, 7, 65),
(66, 'unknown', '2010-01-01', 'violet', 'canada', '', '', 0, 8, 66),
(67, '23456', '1950-01-01', 'rouge', 'italie', '', '', 0, 8, 67),
(68, '65432', '1902-01-01', 'rouge', 'espagne', '', '', 0, 8, 68),
(69, '123456789', '1901-01-01', 'rouge', 'espagne', '', '', 0, 9, 69),
(70, '123456789', '1983-01-01', 'rouge', 'canada', '', '', 0, 9, 70),
(71, 'lkio98765', '1983-01-01', 'vert', 'espagne', '', '', 1, 10, 71),
(72, '987654', '1983-01-01', 'vert', 'canada', '', '', 0, 9, 72),
(73, '5432', '1976-01-01', 'vert', 'canada', '', '', 0, 1, 73),
(74, 'Harvey', '1956-01-01', 'vert', 'espagne', '', '', 1, 9, 74);

-- --------------------------------------------------------

--
-- Structure de la table `UTILISATEUR`
--

CREATE TABLE `UTILISATEUR` (
  `utilisateur_id` smallint(5) UNSIGNED NOT NULL,
  `utilisateur_nom` varchar(50) NOT NULL,
  `utilisateur_prenom` varchar(50) NOT NULL,
  `utilisateur_courriel` varchar(100) NOT NULL,
  `utilisateur_mdp` varchar(255) NOT NULL,
  `utilisateur_adresse` varchar(50) NOT NULL,
  `role_id` smallint(5) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `UTILISATEUR`
--

INSERT INTO `UTILISATEUR` (`utilisateur_id`, `utilisateur_nom`, `utilisateur_prenom`, `utilisateur_courriel`, `utilisateur_mdp`, `utilisateur_adresse`, `role_id`) VALUES
(1, 'admintes', 'test', 'test@test.ca', 'fb86376cb7bfd6553d365f1e9da9886c18d2b3adc19016202d0e32457e145d2b43cefeb08b3a871bc336048e1d62db32d88f3ad21d7231dc48922836bdb41855', '123 rue allo montreal qc canada', 1),
(2, 'Cartier', 'Jean', 'jeancartier@mail.ca', 'fb86376cb7bfd6553d365f1e9da9886c18d2b3adc19016202d0e32457e145d2b43cefeb08b3a871bc336048e1d62db32d88f3ad21d7231dc48922836bdb41855', '111 jeantalon montreal qc can ', 2),
(3, 'mari', 'leblanc', 'mari@leblanc.ca', '1f6f37c530c775842dc907ec3553edaf5d7d08c8327c78359312822e4e9adcebd0475cc92d02bd8d25952ba1c2f6da4b3ce5546618dec93059e2d6611118f466', '123 djeje mejejd', 2),
(4, 'Carrier', 'Maryline', 'maryline888@gmail.com', '1f6f37c530c775842dc907ec3553edaf5d7d08c8327c78359312822e4e9adcebd0475cc92d02bd8d25952ba1c2f6da4b3ce5546618dec93059e2d6611118f466', '34', 2),
(5, 'Tremblay', 'Jeanne', 'tremblay@bmaial.com', '1f6f37c530c775842dc907ec3553edaf5d7d08c8327c78359312822e4e9adcebd0475cc92d02bd8d25952ba1c2f6da4b3ce5546618dec93059e2d6611118f466', '9 rue allie', 2),
(6, 'Vincent', 'Renald', 'vince@homail.com', '1f6f37c530c775842dc907ec3553edaf5d7d08c8327c78359312822e4e9adcebd0475cc92d02bd8d25952ba1c2f6da4b3ce5546618dec93059e2d6611118f466', '34 du ruisseau', 2),
(7, 'Nouchard', 'Lucien', 'lulu@hotmail.com', '1f6f37c530c775842dc907ec3553edaf5d7d08c8327c78359312822e4e9adcebd0475cc92d02bd8d25952ba1c2f6da4b3ce5546618dec93059e2d6611118f466', '908 blabla Longueuil', 2),
(8, 'Lilo', 'Ginette', 'gigi@hotmail.com', '1f6f37c530c775842dc907ec3553edaf5d7d08c8327c78359312822e4e9adcebd0475cc92d02bd8d25952ba1c2f6da4b3ce5546618dec93059e2d6611118f466', '12 fds sdsd', 2),
(9, 'Carrier', 'Maryline', 'maryline888@gmail.com', '9674a3d9a7d5f675c5cb3094ebc18ac93ac1532b4a5ada46bab0cc8f18d6e389065c259bb4a2bae59f2239c57d447b743a5bfced777db20188ca452c1cf7226b', 'wefrwwef', 1),
(10, 'Verne', 'Jules', 'julesV@caramail.com', '9674a3d9a7d5f675c5cb3094ebc18ac93ac1532b4a5ada46bab0cc8f18d6e389065c259bb4a2bae59f2239c57d447b743a5bfced777db20188ca452c1cf7226b', '98 rue du duc london', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ENCHERE`
--
ALTER TABLE `ENCHERE`
  ADD PRIMARY KEY (`enchere_id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Index pour la table `FAVORIS`
--
ALTER TABLE `FAVORIS`
  ADD PRIMARY KEY (`utilisateur_id`,`enchere_id`),
  ADD KEY `enchere_id` (`enchere_id`);

--
-- Index pour la table `IMAGE`
--
ALTER TABLE `IMAGE`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `timbre_id` (`timbre_id`);

--
-- Index pour la table `MISE`
--
ALTER TABLE `MISE`
  ADD PRIMARY KEY (`mise_id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`),
  ADD KEY `enchere_id` (`enchere_id`);

--
-- Index pour la table `ROLE`
--
ALTER TABLE `ROLE`
  ADD PRIMARY KEY (`role_id`);

--
-- Index pour la table `TIMBRE`
--
ALTER TABLE `TIMBRE`
  ADD PRIMARY KEY (`timbre_id`),
  ADD KEY `utilisateur` (`utilisateur`),
  ADD KEY `enchere_id` (`enchere_id`);

--
-- Index pour la table `UTILISATEUR`
--
ALTER TABLE `UTILISATEUR`
  ADD PRIMARY KEY (`utilisateur_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ENCHERE`
--
ALTER TABLE `ENCHERE`
  MODIFY `enchere_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT pour la table `IMAGE`
--
ALTER TABLE `IMAGE`
  MODIFY `image_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT pour la table `MISE`
--
ALTER TABLE `MISE`
  MODIFY `mise_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `TIMBRE`
--
ALTER TABLE `TIMBRE`
  MODIFY `timbre_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT pour la table `UTILISATEUR`
--
ALTER TABLE `UTILISATEUR`
  MODIFY `utilisateur_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ENCHERE`
--
ALTER TABLE `ENCHERE`
  ADD CONSTRAINT `enchere_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `UTILISATEUR` (`utilisateur_id`);

--
-- Contraintes pour la table `FAVORIS`
--
ALTER TABLE `FAVORIS`
  ADD CONSTRAINT `favoris_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `UTILISATEUR` (`utilisateur_id`),
  ADD CONSTRAINT `favoris_ibfk_2` FOREIGN KEY (`enchere_id`) REFERENCES `ENCHERE` (`enchere_id`);

--
-- Contraintes pour la table `IMAGE`
--
ALTER TABLE `IMAGE`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`timbre_id`) REFERENCES `TIMBRE` (`timbre_id`);

--
-- Contraintes pour la table `MISE`
--
ALTER TABLE `MISE`
  ADD CONSTRAINT `mise_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `UTILISATEUR` (`utilisateur_id`),
  ADD CONSTRAINT `mise_ibfk_2` FOREIGN KEY (`enchere_id`) REFERENCES `ENCHERE` (`enchere_id`);

--
-- Contraintes pour la table `TIMBRE`
--
ALTER TABLE `TIMBRE`
  ADD CONSTRAINT `timbre_ibfk_1` FOREIGN KEY (`utilisateur`) REFERENCES `UTILISATEUR` (`utilisateur_id`),
  ADD CONSTRAINT `timbre_ibfk_2` FOREIGN KEY (`enchere_id`) REFERENCES `ENCHERE` (`enchere_id`);

--
-- Contraintes pour la table `UTILISATEUR`
--
ALTER TABLE `UTILISATEUR`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `ROLE` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

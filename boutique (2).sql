-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 22 fév. 2021 à 09:53
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `boutique`
--
CREATE DATABASE IF NOT EXISTS `boutique` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `boutique`;

-- --------------------------------------------------------

--
-- Structure de la table `adresse_particulier`
--

DROP TABLE IF EXISTS `adresse_particulier`;
CREATE TABLE IF NOT EXISTS `adresse_particulier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `boutique_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `adresse` varchar(100) NOT NULL,
  `code` int(11) NOT NULL,
  `ville` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`user_id`),
  KEY `boutique_id` (`boutique_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `adresse_particulier`
--

INSERT INTO `adresse_particulier` (`id`, `boutique_id`, `user_id`, `adresse`, `code`, `ville`) VALUES
(13, NULL, 26, '22 rue poucel', 13004, 'Marseille'),
(20, NULL, 27, '56 rue Jean Mermoz', 130000, 'Marseille'),
(21, NULL, 29, '22 rue du chatounet', 13007, 'marseille'),
(22, NULL, 28, '56 rue Jean Mermoz', 13008, 'Marseille'),
(23, NULL, 30, '0 rue des fous', 13001, 'Marseille'),
(24, NULL, 31, '123 Chemin du Cabillot', 13300, 'Salon de Provence');

-- --------------------------------------------------------

--
-- Structure de la table `adresse_pro`
--

DROP TABLE IF EXISTS `adresse_pro`;
CREATE TABLE IF NOT EXISTS `adresse_pro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `boutique_id` int(11) NOT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `code` int(11) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `boutique_id` (`boutique_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `adresse_pro`
--

INSERT INTO `adresse_pro` (`id`, `boutique_id`, `adresse`, `code`, `ville`) VALUES
(7, 18, '22 rue poucel', 13004, 'Marseille'),
(8, 19, '11 chemin du pas', 13005, 'marseille'),
(9, 20, '28 rue de la libertÃ©', 69069, 'Lyon'),
(10, 21, '22 rue Poucel', 13004, 'Marseille'),
(11, 22, '22 rue du chaton', 13004, 'marseille'),
(12, 23, '11 chemin du pas', 13005, 'marseille');

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

DROP TABLE IF EXISTS `annonce`;
CREATE TABLE IF NOT EXISTS `annonce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `poids` float NOT NULL,
  `prix` int(11) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categorie_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `boutique_pro_id` int(11) DEFAULT NULL,
  `boutique_particulier_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`user_id`),
  KEY `boutiques_pro_id` (`boutique_pro_id`,`boutique_particulier_id`),
  KEY `user_id` (`user_id`,`boutique_pro_id`,`boutique_particulier_id`),
  KEY `annonce_ibfk_1` (`boutique_particulier_id`),
  KEY `categorie_id` (`categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`id`, `titre`, `description`, `poids`, `prix`, `stock`, `create_at`, `categorie_id`, `user_id`, `boutique_pro_id`, `boutique_particulier_id`) VALUES
(74, 'sd', 'sd', 1, 1, 1, '2021-02-22 01:07:50', 1, NULL, 18, NULL),
(75, 'mll', ';m;m', 5, 5, 5, '2021-02-22 01:20:38', 1, NULL, NULL, 15),
(76, 'mll', ';m;m', 5, 5, 5, '2021-02-22 01:21:08', 1, NULL, NULL, 15),
(77, 'tr', ';m;m', 5, 5000, 5, '2021-02-22 01:22:10', 1, NULL, NULL, 15),
(78, 'nbkn', 'nliojnoi', 1, 2, 5, '2021-02-22 02:20:26', 1, NULL, NULL, 15);

-- --------------------------------------------------------

--
-- Structure de la table `boutique_particulier`
--

DROP TABLE IF EXISTS `boutique_particulier`;
CREATE TABLE IF NOT EXISTS `boutique_particulier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_boutique` varchar(100) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `droit_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`user_id`),
  KEY `droit_id` (`droit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `boutique_particulier`
--

INSERT INTO `boutique_particulier` (`id`, `nom_boutique`, `create_at`, `droit_id`, `user_id`) VALUES
(10, 'le stand de Manu', '2021-02-12 11:15:26', 10, 26),
(14, 'minou et minette', '2021-02-18 17:18:11', 10, 29),
(15, 'dinoland', '2021-02-18 18:13:34', 10, 28),
(16, 'zuzu', '2021-02-19 11:42:04', 10, 30),
(17, 'MHCORP', '2021-02-19 13:58:02', 10, 31);

-- --------------------------------------------------------

--
-- Structure de la table `boutique_pro`
--

DROP TABLE IF EXISTS `boutique_pro`;
CREATE TABLE IF NOT EXISTS `boutique_pro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) NOT NULL,
  `droit_id` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `siret` varchar(255) NOT NULL,
  `rib` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `droit_id` (`droit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `boutique_pro`
--

INSERT INTO `boutique_pro` (`id`, `nom`, `email`, `password`, `droit_id`, `create_at`, `siret`, `rib`) VALUES
(18, 'Les chats en folie', 'chacha@hotmail.fr', '$argon2i$v=19$m=65536,t=4,p=1$MFhsLlpELk56d2RrZnZHUA$F3vZjRQyyvV1Guh5AJ9apTA/9SucZN02dpvAIvBz/is', 20, '2021-02-12 12:38:37', '2525525', NULL),
(19, 'leo', 'leonard@yahoo.fr', '$argon2i$v=19$m=65536,t=4,p=1$bDZlWTV6RW5SNWhnV2d3cQ$wonzC9C8Xh3Mwu6vOQpqlrqD17xG7D+qBgPFSfE58nQ', 20, '2021-02-18 17:32:23', '544783627541211', NULL),
(20, 'Panda', 'panda@hotmail.fr', '$argon2i$v=19$m=65536,t=4,p=1$ckQwWThUTThvV3MvNGJ4dA$GhYlb2Kv1HLzPBMJYC5XI8jxtOi/l22MqvdBgUzYIRI', 20, '2021-02-18 18:49:17', '5555555555555', NULL),
(21, 'cassiopÃ©e', 'cass@hotmail.fr', '$argon2i$v=19$m=65536,t=4,p=1$dXZGLnQ3OFNpdzlYWVZ4SQ$PxlEi3erhOv93DMCB2uhDyQMFsUgGH0JtoYMzWUTOVE', 20, '2021-02-18 18:55:59', '5555555555555555', NULL),
(22, 'bibi', 'bibi@hotmail.fr', '$argon2i$v=19$m=65536,t=4,p=1$RUVyWnVXNVBVYVZ5andBUw$7ol1B9MGcwqV/bCwvb1akn0ldt54K4fsIp4tH3XNOR0', 20, '2021-02-18 18:59:09', '55555555555', NULL),
(23, 'titi', 'titi@hotmail.fr', '$argon2i$v=19$m=65536,t=4,p=1$eVNYZ3lvSnY1VzBwVW8zUg$Kngd865YojrdZdmt/k3sNOwieGSL5gXD57H65ii9Nqk', 20, '2021-02-18 19:00:57', '7777777777', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'Animalerie'),
(2, 'ameublement'),
(3, 'enfant'),
(5, 'vêtements'),
(6, 'Bijoux'),
(7, 'Artisanat'),
(8, 'informatique'),
(9, 'multimédia');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prix_commande` int(11) NOT NULL,
  `prix_livraison` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `boutique_particulier_id` int(11) NOT NULL,
  `boutique_pro_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`user_id`),
  KEY `boutiques_particuliers_id` (`boutique_particulier_id`),
  KEY `boutiques_pro_id` (`boutique_pro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `note` int(11) NOT NULL,
  `commentaire` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `boutique_particulier_id` int(11) DEFAULT NULL,
  `boutique_pro_id` int(11) DEFAULT NULL,
  `annonce_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`user_id`),
  KEY `boutique_particulier_id` (`boutique_particulier_id`),
  KEY `boutique_pro_id` (`boutique_pro_id`),
  KEY `annonce_id` (`annonce_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `droit`
--

DROP TABLE IF EXISTS `droit`;
CREATE TABLE IF NOT EXISTS `droit` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `droit`
--

INSERT INTO `droit` (`id`, `nom`) VALUES
(10, 'boutique particulier'),
(20, 'boutique professionnel'),
(43, 'modérateur'),
(1337, 'administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

DROP TABLE IF EXISTS `livraison`;
CREATE TABLE IF NOT EXISTS `livraison` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poids_min` float NOT NULL,
  `poids_max` float NOT NULL,
  `prix` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `livraison`
--

INSERT INTO `livraison` (`id`, `poids_min`, `poids_max`, `prix`) VALUES
(1, 0, 0.5, 4.55),
(2, 0.501, 1, 5.35),
(3, 1.001, 2, 6.05),
(4, 2.001, 3, 6.95),
(5, 3.001, 5, 8.15),
(6, 5.001, 7, 10.75),
(7, 7.001, 10, 12.6),
(8, 10.001, 15, 15.7),
(9, 15.001, 30, 36),
(10, 30.001, 120, 50);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `annonce_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `annonces_id` (`annonce_id`),
  KEY `users_id` (`user_id`),
  KEY `annonce_id` (`annonce_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `photo_annonce`
--

DROP TABLE IF EXISTS `photo_annonce`;
CREATE TABLE IF NOT EXISTS `photo_annonce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo` varchar(100) NOT NULL,
  `annonce_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `annonce_id` (`annonce_id`),
  KEY `annonce_id_2` (`annonce_id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `photo_annonce`
--

INSERT INTO `photo_annonce` (`id`, `photo`, `annonce_id`) VALUES
(52, '74.png', 74),
(64, '75.jpg', 75),
(65, '76.jpg', 76),
(66, '77.png', 77),
(67, '78.jpg', 78);

-- --------------------------------------------------------

--
-- Structure de la table `photo_avatar`
--

DROP TABLE IF EXISTS `photo_avatar`;
CREATE TABLE IF NOT EXISTS `photo_avatar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `boutique_particulier_id` int(11) DEFAULT NULL,
  `boutique_pro_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `photo_avatar`
--

INSERT INTO `photo_avatar` (`id`, `photo`, `user_id`, `boutique_particulier_id`, `boutique_pro_id`) VALUES
(30, '15.png', NULL, 15, NULL),
(31, '18.jpg', NULL, NULL, '18'),
(39, '28.jpg', 28, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `prix` int(11) NOT NULL,
  `quantité` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `boutique_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`user_id`),
  KEY `boutique_id` (`boutique_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `droit_id` int(11) DEFAULT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `droit_id` (`droit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `droit_id`, `nom`, `prenom`, `create_at`, `email`, `password`) VALUES
(26, 10, 'Cabassot', 'Emmanuel', '2021-02-17 20:30:38', 'emmanuel.cabassot@laplateforme.io', '$argon2i$v=19$m=65536,t=4,p=1$enNMQ1VQY09VQXdWbUFUMw$hwJaQlVXU/XillY3sdirGZmNaLYwNdL2egOLj9BUa48'),
(27, 1, 'Cabassot', 'Lou', '2021-02-17 20:30:38', 'lou@hotamil.fr', '$argon2i$v=19$m=65536,t=4,p=1$QXVrSURFSEU3a1BNN1BJMw$cIdUW4s0cGtW7Bm1HWawqoOOL3PdzZU04+Xt3E82TDA'),
(28, 10, 'Cabassot', 'Adrien', '2021-02-17 20:30:38', 'adrien@hotmail.fr', '$argon2i$v=19$m=65536,t=4,p=1$THM2eEloUjEzZFRkQXRqYg$/CNddIdGQiJpzikyGebMRx/FHKQZ/1H48JhnfAS8qbA'),
(29, 10, 'chat', 'chat', '2021-02-18 16:59:22', 'chatchat@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$REo4VXNDOGc2UUhJR3plZA$PjltlbA3BiLGTCNKsctcjpTMGygnCleBBQHY12+kaQI'),
(30, 10, 'Tenorio', 'Fabio', '2021-02-19 11:38:32', 'fabiovalho@fabio.br', '$argon2i$v=19$m=65536,t=4,p=1$NjZ4VEhwY0JHLkNzUmxlaw$CicqIX0JhT7vdBpI4YQYbWZqZ3Z6yoU+vxa1lzryxYA'),
(31, 10, 'tavernier', 'mathias', '2021-02-19 13:55:26', 'mathias.tavernier1@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$b0I3dG5hTE55bkdvLjB5bw$Cl781vH93l/XENqxkUNd0K85XvJyxukUeVVYx4V/CnU');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresse_particulier`
--
ALTER TABLE `adresse_particulier`
  ADD CONSTRAINT `fk_adressePar_boutiqueParticulier` FOREIGN KEY (`boutique_id`) REFERENCES `boutique_particulier` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_adressePar_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `adresse_pro`
--
ALTER TABLE `adresse_pro`
  ADD CONSTRAINT `fk_adressePro` FOREIGN KEY (`boutique_id`) REFERENCES `boutique_pro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD CONSTRAINT `annonce_ibfk_1` FOREIGN KEY (`boutique_particulier_id`) REFERENCES `boutique_particulier` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `annonce_ibfk_2` FOREIGN KEY (`boutique_pro_id`) REFERENCES `boutique_pro` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `annonce_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `annonce_ibfk_4` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `boutique_particulier`
--
ALTER TABLE `boutique_particulier`
  ADD CONSTRAINT `boutique_particulier_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_boutiqueParticulier_droit` FOREIGN KEY (`droit_id`) REFERENCES `droit` (`id`);

--
-- Contraintes pour la table `boutique_pro`
--
ALTER TABLE `boutique_pro`
  ADD CONSTRAINT `fk_boutiquePro_droit` FOREIGN KEY (`droit_id`) REFERENCES `droit` (`id`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `fk_commentaire_annonce` FOREIGN KEY (`annonce_id`) REFERENCES `annonce` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_commentaire_boutiqueParticulier` FOREIGN KEY (`boutique_particulier_id`) REFERENCES `boutique_particulier` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_commentaire_boutiquePro` FOREIGN KEY (`boutique_pro_id`) REFERENCES `boutique_pro` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_commentaire_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `fk_annonceId_annonce` FOREIGN KEY (`annonce_id`) REFERENCES `annonce` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_panier_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `photo_annonce`
--
ALTER TABLE `photo_annonce`
  ADD CONSTRAINT `fk_photo-annonce_annnonce` FOREIGN KEY (`annonce_id`) REFERENCES `annonce` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `photo_avatar`
--
ALTER TABLE `photo_avatar`
  ADD CONSTRAINT `fk_photoAvatar_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

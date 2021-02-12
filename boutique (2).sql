-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 12 fév. 2021 à 09:24
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `adresse_particulier`
--

INSERT INTO `adresse_particulier` (`id`, `boutique_id`, `user_id`, `adresse`, `code`, `ville`) VALUES
(12, NULL, 24, ',jpkop', 5585, 'niomjnomij');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

DROP TABLE IF EXISTS `annonce`;
CREATE TABLE IF NOT EXISTS `annonce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  `boutique_pro_id` int(11) DEFAULT NULL,
  `boutique_particulier_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`user_id`),
  KEY `boutiques_pro_id` (`boutique_pro_id`,`boutique_particulier_id`),
  KEY `user_id` (`user_id`,`boutique_pro_id`,`boutique_particulier_id`),
  KEY `annonce_ibfk_1` (`boutique_particulier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `boutique_particulier`
--

INSERT INTO `boutique_particulier` (`id`, `nom_boutique`, `create_at`, `droit_id`, `user_id`) VALUES
(9, 'jiojopjoi^joijpj', '2021-02-12 10:12:15', 10, 24);

-- --------------------------------------------------------

--
-- Structure de la table `boutique_pro`
--

DROP TABLE IF EXISTS `boutique_pro`;
CREATE TABLE IF NOT EXISTS `boutique_pro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `droit_id` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `siret` varchar(255) NOT NULL,
  `rib` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `droit_id` (`droit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `photo_avatar`
--

DROP TABLE IF EXISTS `photo_avatar`;
CREATE TABLE IF NOT EXISTS `photo_avatar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo` varchar(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `droit_id` (`droit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `droit_id`, `nom`, `prenom`, `email`, `password`) VALUES
(20, NULL, 'cabassot', 'Adrien', 'adrien@hotmail.fr', '$argon2i$v=19$m=65536,t=4,p=1$eVZtck9LTUZ1SloyZkRqSg$5Xxx7mnfOL3R161xdGMvwJ9v4QBcHowgQyxVJPj6F3k'),
(21, NULL, 'cabassot', 'lou', 'lou@hotamil.fr', '$argon2i$v=19$m=65536,t=4,p=1$MVR2ZHhqb2t5MkozNWN6bw$xreBHDbaMrPggBWuSbOpY5ZpIzyh2ysymlVBV9r8SY4'),
(22, NULL, 'KDJSO', '?DKS', '?DLKS?P@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$ZzduU2c3eW53M096cEp5Wg$0ohO22uYtBiGmupSp9Thae62hiscsWK5j3LGxJZjNFY'),
(23, NULL, 'mapetitiefemme', 'pareil', 'femme@hotm.fr', '$argon2i$v=19$m=65536,t=4,p=1$MEd1VVhRL3ZmTWpIclJLWQ$rRqGxZsL3teM06N8gk6oLEA1uk1+X1DO+mvrtpG4zqA'),
(24, 10, 'toto', 'toto', 'toto@toto', '$argon2i$v=19$m=65536,t=4,p=1$U3hnYzM5MDc5YmE3S1RLZQ$ET0h/bFkYkmYeE8gKwsy+r4/kpk6j6CG99mKUZchj7o');

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
  ADD CONSTRAINT `annonce_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

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

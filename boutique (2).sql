-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 11 fév. 2021 à 10:10
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
  `user_id` int(11) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `code` int(11) NOT NULL,
  `ville` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `adresse_pro`
--

DROP TABLE IF EXISTS `adresse_pro`;
CREATE TABLE IF NOT EXISTS `adresse_pro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `code` int(11) NOT NULL,
  `ville` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

DROP TABLE IF EXISTS `annonce`;
CREATE TABLE IF NOT EXISTS `annonce` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `photo_id` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `boutique_pro_id` int(11) NOT NULL,
  `boutique_particulier_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`user_id`),
  KEY `boutiques_pro_id` (`boutique_pro_id`,`boutique_particulier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `boutique_particulier`
--

DROP TABLE IF EXISTS `boutique_particulier`;
CREATE TABLE IF NOT EXISTS `boutique_particulier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_boutique` varchar(60) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `droit_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`user_id`),
  KEY `droit_id` (`droit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `adresse_id` int(11) NOT NULL,
  `siret` varchar(255) NOT NULL,
  `rib` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `droit_id` (`droit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

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
  `boutique_particulier_id` int(11) NOT NULL,
  `boutique_pro_id` int(11) NOT NULL,
  `annonce_id` int(11) NOT NULL,
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
  `nom` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `boutique_particulier_id` int(11) NOT NULL,
  `boutique_pro_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`user_id`,`boutique_particulier_id`,`boutique_pro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  KEY `annonce_id` (`annonce_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `photo_avatar`
--

DROP TABLE IF EXISTS `photo_avatar`;
CREATE TABLE IF NOT EXISTS `photo_avatar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `boutique_pro_id` int(11) DEFAULT NULL,
  `boutique_particulier_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`boutique_pro_id`,`boutique_particulier_id`)
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
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `password`) VALUES
(7, 'Cabassot', 'Emmanuel', 'emmanuel.cabassot@laplateforme.io', '0000');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

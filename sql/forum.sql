-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 18 jan. 2021 à 15:27
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `aime`
--

DROP TABLE IF EXISTS `aime`;
CREATE TABLE IF NOT EXISTS `aime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_message` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `aime` tinyint(1) NOT NULL,
  `pas_aime` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `aime`
--

INSERT INTO `aime` (`id`, `id_message`, `id_user`, `aime`, `pas_aime`) VALUES
(1, 2, 1, 1, 0),
(2, 7, 1, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
CREATE TABLE IF NOT EXISTS `conversations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_topic` int(11) NOT NULL,
  `date_creation` datetime NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `id_createur` int(11) NOT NULL,
  `id_visibilite` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `conversations`
--

INSERT INTO `conversations` (`id`, `id_topic`, `date_creation`, `sujet`, `id_createur`, `id_visibilite`) VALUES
(1, 1, '2021-01-18 15:32:55', 'La balise head ', 3, 0),
(2, 2, '2021-01-18 15:35:25', 'Les id/classes ', 2, 1),
(3, 2, '2021-01-18 15:37:02', 'Les media queries', 1, 1),
(4, 1, '2021-01-18 15:39:41', 'La structure d\'une page ', 1, 0),
(5, 3, '2021-01-18 15:41:47', 'Les boucles ', 3, 2),
(6, 4, '2021-01-18 15:48:06', 'La grille bootstrap', 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_conversations` int(11) NOT NULL,
  `id_topic` int(11) NOT NULL,
  `id_posteur` int(11) NOT NULL,
  `date_heure_post` datetime NOT NULL,
  `message` text NOT NULL,
  `id_visibilite` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `id_conversations`, `id_topic`, `id_posteur`, `date_heure_post`, `message`, `id_visibilite`) VALUES
(1, 1, 1, 3, '2021-01-18 15:33:28', 'Trop cool le html', 0),
(2, 2, 2, 2, '2021-01-18 15:35:35', 'Vive le css', 1),
(3, 1, 1, 2, '2021-01-18 15:35:51', 'Ouais grave', 0),
(4, 3, 2, 1, '2021-01-18 15:37:14', 'Vive le responsive', 1),
(5, 2, 2, 1, '2021-01-18 15:37:31', 'Ouais ', 1),
(6, 1, 1, 1, '2021-01-18 15:38:45', 'Jelly beans icing jujubes icing. Chocolate cake pudding bonbon. Pie apple pie pudding sesame snaps jelly beans pie bear claw. ðŸ˜€ðŸ˜€', 0),
(7, 4, 1, 1, '2021-01-18 15:40:02', 'Marshmallow chocolate cookie lollipop topping macaroon liquorice dragÃ©e gummi bears.', 0),
(8, 5, 3, 3, '2021-01-18 15:42:13', 'Jelly beans icing jujubes icing. Chocolate cake pudding bonbon. Pie apple pie pudding sesame snaps jelly beans pie bear claw.', 2),
(9, 2, 2, 4, '2021-01-18 15:45:42', 'Trop cool', 1),
(10, 6, 4, 3, '2021-01-18 15:48:27', 'Marshmallow chocolate cookie lollipop topping macaroon liquorice dragÃ©e gummi bears.', 3);

-- --------------------------------------------------------

--
-- Structure de la table `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_createur` int(11) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_heure_creation` datetime NOT NULL,
  `id_visibilite` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `topics`
--

INSERT INTO `topics` (`id`, `id_createur`, `sujet`, `description`, `date_heure_creation`, `id_visibilite`) VALUES
(1, 3, 'Sujet Public : Le html', 'Spiderman se met à coder', '2021-01-18 15:32:37', 0),
(2, 2, 'Sujet User connecté : le css', 'Batman fait du css', '2021-01-18 15:35:02', 1),
(3, 3, 'Sujet Modo : Le php', 'C\'est pas facile', '2021-01-18 15:41:33', 2),
(4, 3, 'Sujet Admin : Bootstrap', 'C\'est pas clair tout ça ', '2021-01-18 15:47:43', 3);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `id_droit` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`, `nom`, `prenom`, `age`, `id_droit`, `avatar`) VALUES
(1, 'bapt', '$2y$10$Gl7oJnEi4CazI5rx/drjFOy12Nw1aLYHaC8BEzJDHSmegrnGttAn.', 'GAUTHIER', 'Baptiste', 21, 1, 'defaut.png'),
(2, 'Batman', '$2y$10$one7p3CtFkBbPTG97HcYnuqps73OZBEN1jmPqQfOXIudRNC9s4/MS', 'WAYNE', 'Bruce', 35, 2, '2.png'),
(3, 'Spiderman', '$2y$10$HXwX3VIt3O0.249F9QfgKeN7gi30XjcHXBvcHHCjx7sFJv1f2lin6', 'PARKER', 'Peter', 23, 3, '3.jpg'),
(4, 'John', '$2y$10$BB0bvR3Bgd9oZ4TfF4ZgJudH.wTDC33NXAsIvbN9DynFNYYEEyD92', 'Doe', 'John', 26, 1, '4.jpg'),
(5, 'Iron Man', '$2y$10$eT.EP3oUw2ncm5tIIU5QwuWxmezHCMq.qYP7umUpfW05Yzj5R6MPS', 'STARK', 'Tony', 45, 3, '5.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

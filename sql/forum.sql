-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 18 jan. 2021 à 13:13
-- Version du serveur :  5.7.24
-- Version de PHP : 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `aime`
--

CREATE TABLE `aime` (
  `id` int(11) NOT NULL,
  `id_message` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `aime` tinyint(1) NOT NULL,
  `pas_aime` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `aime`
--

INSERT INTO `aime` (`id`, `id_message`, `id_user`, `aime`, `pas_aime`) VALUES
(370, 8, 14, 1, 0),
(373, 13, 9, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `id_topic` int(11) NOT NULL,
  `date_creation` datetime NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `id_createur` int(11) NOT NULL,
  `id_visibilite` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `conversations`
--

INSERT INTO `conversations` (`id`, `id_topic`, `date_creation`, `sujet`, `id_createur`, `id_visibilite`) VALUES
(123, 12, '2021-01-13 14:34:54', 'Test moderateur', 14, 2),
(122, 11, '2021-01-13 14:34:41', 'Test utilisateur co', 14, 1),
(121, 10, '2021-01-13 11:30:29', 'Test Conv Publique', 14, 0),
(124, 13, '2021-01-13 14:38:15', 'Conversation Gaspardg', 14, 0),
(125, 14, '2021-01-13 14:40:50', 'Test modérateur 2', 14, 2),
(126, 13, '2021-01-14 19:21:12', 'hello', 18, 0),
(127, 11, '2021-01-14 20:32:51', 'Test', 18, 1),
(128, 11, '2021-01-15 16:56:52', 'Héhé', 8, 1),
(129, 10, '2021-01-18 10:53:42', 'Test publique', 9, 0),
(130, 10, '2021-01-18 11:20:02', 'Truc', 9, 0),
(131, 10, '2021-01-18 11:20:09', 'tfdgfd', 9, 0),
(132, 10, '2021-01-18 11:20:25', 'tfdgfd', 9, 0),
(133, 10, '2021-01-18 11:20:36', 'tfdgfd', 9, 0),
(134, 10, '2021-01-18 11:20:43', 'tfdgfd', 9, 0);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `id_topic` int(11) NOT NULL,
  `id_conversations` int(11) NOT NULL,
  `id_posteur` int(11) NOT NULL,
  `date_heure_post` datetime NOT NULL,
  `message` text NOT NULL,
  `id_visibilite` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `id_topic`, `id_conversations`, `id_posteur`, `date_heure_post`, `message`, `id_visibilite`) VALUES
(1, 124, 124, 14, '2021-01-14 10:41:50', 'truc', 0),
(2, 124, 124, 14, '2021-01-14 10:41:57', 'truc', 0),
(3, 124, 124, 16, '2021-01-14 14:38:08', 'Test', 0),
(4, 126, 126, 18, '2021-01-14 19:21:20', 'hello', 0),
(5, 126, 126, 18, '2021-01-14 19:21:42', 'hello', 0),
(6, 126, 126, 18, '2021-01-14 19:24:19', 'hello', 0),
(7, 126, 126, 18, '2021-01-14 19:26:28', 'hello', 0),
(8, 126, 126, 18, '2021-01-14 19:30:48', 'hello', 0),
(9, 126, 126, 18, '2021-01-14 19:31:23', 'hello', 0),
(10, 126, 126, 18, '2021-01-14 19:37:02', 'hello', 0),
(11, 126, 126, 18, '2021-01-14 19:37:42', 'hello', 0),
(12, 121, 121, 18, '2021-01-14 20:06:10', ',nb,\r\n', 0),
(13, 129, 129, 9, '2021-01-18 10:53:55', 'Test', 0),
(14, 10, 129, 9, '2021-01-18 12:00:35', 'Test nouvelle id', 0);

-- --------------------------------------------------------

--
-- Structure de la table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `id_createur` int(11) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_heure_creation` datetime NOT NULL,
  `id_visibilite` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `topics`
--

INSERT INTO `topics` (`id`, `id_createur`, `sujet`, `description`, `date_heure_creation`, `id_visibilite`) VALUES
(10, 14, 'Topic publique', 'Topic publique', '2021-01-12 18:57:39', 0),
(8, 14, 'Test admin', 'Test admin', '2021-01-12 16:44:58', 3),
(9, 14, 'Test modio', 'Test modo', '2021-01-12 16:45:16', 2),
(11, 14, 'Test Utilisateur co', 'Test Utilisateur co', '2021-01-12 18:58:02', 1),
(12, 14, 'Test moderateur', 'Test moderateur', '2021-01-12 18:58:28', 2),
(13, 14, 'Test publique Gaspardg', 'truc', '2021-01-13 14:37:33', 0),
(14, 14, 'Test moderateur 2', 'truc', '2021-01-13 14:39:51', 2),
(15, 14, 'Test Bapt', 'Test Bapt', '2021-01-14 14:57:04', 3);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `id_droit` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`, `nom`, `prenom`, `age`, `id_droit`, `avatar`) VALUES
(2, 'USER', '$2y$10$2VZX.l5pwKacsRU.4S6WZupiHh1RRWdh8PpLx33BtPx8VGQY5lhwi', 'USER', 'USER', 43, 1, '2.png'),
(3, 'MODO', '$2y$10$2VZX.l5pwKacsRU.4S6WZupiHh1RRWdh8PpLx33BtPx8VGQY5lhwi', 'MODO', 'MODO', 43, 2, 'defaut.png'),
(4, 'ADMIN', '$2y$10$2VZX.l5pwKacsRU.4S6WZupiHh1RRWdh8PpLx33BtPx8VGQY5lhwi', 'ADMIN', 'ADMIN', 43, 3, 'defaut.png'),
(5, 'user 2 ', '$2y$10$rUH7T1O9ulccifTpDqaW9OgRjHhUitdev8xkCuOrDggNbU9XGYwEe', 'user 2 ', 'user 2 ', 25, 1, 'defaut.png'),
(6, 'aaaa', '$2y$10$PSCZWSOVui92WsYWZ0mAGen9eoTk4Dt8ETg7vf0el.mDx4bsdfYN2', 'aaaa', 'aaaa', 52, 1, '17.jpg'),
(7, 'Boujour', '$2y$10$ournBcVTzXyl6pN0nObSpu8JIqroleTb0imlV4YIoD7ZmwURCK1Ya', 'Test', 'Test', 20, 1, 'defaut.png'),
(8, 'Bonsoir', '$2y$10$KEB5szlbqJ1.ecdDVwCSP.cxESdRD9.9bf3YY9kfPk3eW5PZNNl4q', 'test', 'test', 20, 1, 'defaut.png'),
(9, 'Gaspardg', '$2y$10$/rSLpwWhxmnq.yo/0U8HZe7QFVM1Y7/iodK0m1dnf5fNeDVkOcbii', 'Bob', 'Bob', 20, 1, '9.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `aime`
--
ALTER TABLE `aime`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `aime`
--
ALTER TABLE `aime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=374;

--
-- AUTO_INCREMENT pour la table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

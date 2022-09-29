-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 29 sep. 2022 à 15:24
-- Version du serveur : 5.7.36
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `movielib`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220929081127', '2022-09-29 08:12:36', 136),
('DoctrineMigrations\\Version20220929081741', '2022-09-29 08:18:34', 84),
('DoctrineMigrations\\Version20220929082416', '2022-09-29 08:25:25', 168),
('DoctrineMigrations\\Version20220929084652', '2022-09-29 08:48:02', 334);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `designation` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id`, `designation`, `icon`) VALUES
(1, 'Comédie', 'comedie.png'),
(2, 'Historique', 'histoire.png'),
(3, 'Science-fiction', 'comedie.png'),
(4, 'Romantique', 'comedie.png'),
(5, 'Thriller', 'thriller.png'),
(6, 'Action', 'comedie.png'),
(7, 'Horreur', 'comedie.png'),
(8, 'Guerre', 'comedie.png'),
(9, 'Musical', 'comedie.png'),
(10, 'Policier', 'comedie.png'),
(11, 'Biographie', 'comedie.png'),
(12, 'Fantastique', 'comedie.png'),
(13, 'Drame', 'comedie.png'),
(14, 'Western', 'cowboy-hat.png');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `movie`
--

DROP TABLE IF EXISTS `movie`;
CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poster` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int(11) NOT NULL,
  `release_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `movie`
--

INSERT INTO `movie` (`id`, `genre_id`, `title`, `poster`, `duration`, `release_at`) VALUES
(1, 14, 'Le Bon, la Brute et le Truand', 'lebonlabruteetletruand.jpg', 161, '1968-03-08'),
(3, 5, 'Usual suspects', 'usualsuspectsjpg', 106, '1995-07-19'),
(4, 14, 'Pour une poignée de dollars', 'f34d6fd1c781df5448d53d206d637079jpg', 100, '1966-03-16');

-- --------------------------------------------------------

--
-- Structure de la table `movie_person`
--

DROP TABLE IF EXISTS `movie_person`;
CREATE TABLE `movie_person` (
  `movie_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `roles` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `movie_person`
--

INSERT INTO `movie_person` (`movie_id`, `person_id`, `roles`) VALUES
(1, 1, '[\"DIRECTOR\"]'),
(1, 2, '[\"ACTOR\"]'),
(1, 3, '[\"ACTOR\"]'),
(1, 4, '[\"ACTOR\"]'),
(3, 5, '[\"DIRECTOR\"]'),
(3, 6, '[\"ACTOR\"]'),
(3, 7, '[\"ACTOR\"]'),
(3, 8, '[\"ACTOR\"]'),
(3, 9, '[\"ACTOR\"]'),
(3, 10, '[\"ACTOR\"]'),
(4, 1, '[\"DIRECTOR\"]'),
(4, 11, '[\"ACTOR\"]'),
(4, 12, '[\"ACTOR\"]');

-- --------------------------------------------------------

--
-- Structure de la table `person`
--

DROP TABLE IF EXISTS `person`;
CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `person`
--

INSERT INTO `person` (`id`, `firstname`, `lastname`, `birth_date`) VALUES
(1, 'Sergio', 'Leone', '1929-01-03'),
(2, 'Clint', 'Eastwood', '1930-05-31'),
(3, 'Lee', 'Van Cleef', '1925-01-09'),
(4, 'Eli', 'Wallach', '1915-12-07'),
(5, 'Bryan', 'Singer', '1965-09-17'),
(6, 'Gabriel', 'Byrne', '1950-05-12'),
(7, 'Kevin', 'Spacey', '1959-07-26'),
(8, 'Stephen', 'Baldwin', '1966-05-12'),
(9, 'Benicio', 'Del Toro', '1967-02-19'),
(10, 'Kevin', 'Pollack', '1957-10-30'),
(11, 'Marianne', 'Koch', '1931-08-19'),
(12, 'Gian Maria', 'Volonté', '1933-04-09');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1D5EF26F4296D31F` (`genre_id`);

--
-- Index pour la table `movie_person`
--
ALTER TABLE `movie_person`
  ADD PRIMARY KEY (`movie_id`,`person_id`),
  ADD KEY `IDX_CD1B4C038F93B6FC` (`movie_id`),
  ADD KEY `IDX_CD1B4C03217BBB47` (`person_id`);

--
-- Index pour la table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `movie`
--
ALTER TABLE `movie`
  ADD CONSTRAINT `FK_1D5EF26F4296D31F` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`);

--
-- Contraintes pour la table `movie_person`
--
ALTER TABLE `movie_person`
  ADD CONSTRAINT `FK_CD1B4C03217BBB47` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`),
  ADD CONSTRAINT `FK_CD1B4C038F93B6FC` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

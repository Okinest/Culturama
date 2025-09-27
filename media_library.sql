-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : sam. 27 sep. 2025 à 14:03
-- Version du serveur : 8.0.40
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `media_library`
--

-- --------------------------------------------------------

--
-- Structure de la table `albums`
--

CREATE TABLE `albums` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `trackNumber` int NOT NULL,
  `editor` varchar(255) NOT NULL,
  `isAvailable` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `albums`
--

INSERT INTO `albums` (`id`, `title`, `author`, `trackNumber`, `editor`, `isAvailable`, `created_at`, `updated_at`, `file_path`) VALUES
(1, 'Abbey Road', 'The Beatles', 17, 'Apple Records', 1, '2025-09-12 19:48:03', '2025-09-27 13:49:41', 'assets/images/albums/abbey_road.webp'),
(2, 'Dark Side of the Moon', 'Pink Floyd', 10, 'Harvest Records', 1, '2025-09-12 19:48:03', '2025-09-27 09:19:27', 'assets/images/albums/dark_side_of_the_moon.png'),
(3, 'Thriller', 'Michael Jackson', 9, 'Epic Records', 1, '2025-09-12 19:48:03', '2025-09-25 22:55:03', 'assets/images/albums/thriller.webp'),
(4, 'A Night at the Opera', 'Queen', 12, 'EMI', 0, '2025-09-12 19:57:38', '2025-09-27 09:16:27', 'assets/images/albums/a_night_at_the_opera.webp');

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `pageNumber` int NOT NULL,
  `isAvailable` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `pageNumber`, `isAvailable`, `created_at`, `updated_at`, `file_path`) VALUES
(1, 'Le Petit Prince', 'Antoine de Saint-Exupéry', 96, 1, '2025-09-11 22:55:25', '2025-09-26 20:08:15', 'assets/images/books/le_petit_prince.jpg'),
(2, '1984', 'George Orwell', 328, 1, '2025-09-11 22:55:25', '2025-09-26 20:07:55', 'assets/images/books/1984.jpg'),
(3, 'L\'Étranger', 'Albert Camus', 159, 1, '2025-09-11 22:55:25', '2025-09-26 20:08:30', 'assets/images/books/l_etranger.jpg'),
(4, 'Les Misérables', 'Victor Hugo', 1488, 1, '2025-09-11 22:55:25', '2025-09-26 20:08:45', 'assets/images/books/les_miserables.jpg'),
(5, 'Harry Potter à l\'école des sorciers', 'J.K. Rowling', 309, 1, '2025-09-11 22:55:25', '2025-09-26 20:09:10', 'assets/images/books/harry_potter_a_l_ecole_des_sorciers.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

CREATE TABLE `movies` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `director` varchar(255) NOT NULL,
  `duration` decimal(5,2) NOT NULL,
  `genre` enum('Action','Comedy','Drama','Horror','SciFi','Documentary') NOT NULL,
  `isAvailable` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`id`, `title`, `director`, `duration`, `genre`, `isAvailable`, `created_at`, `updated_at`, `file_path`) VALUES
(1, 'Inception', 'Christopher Nolan', 148.00, 'SciFi', 1, '2025-09-12 10:17:34', '2025-09-27 09:22:53', 'assets/images/movies/inception.webp'),
(2, 'The Dark Knight', 'Christopher Nolan', 152.00, 'Action', 0, '2025-09-12 10:17:34', '2025-09-27 09:19:19', 'assets/images/movies/the_dark_knight.jpg'),
(3, 'Pulp Fiction', 'Quentin Tarantino', 154.00, 'Drama', 1, '2025-09-12 10:17:34', '2025-09-26 20:11:19', 'assets/images/movies/pulp_fiction.jpg'),
(4, 'The Shining', 'Stanley Kubrick', 146.00, 'Horror', 1, '2025-09-12 10:17:34', '2025-09-26 20:11:32', 'assets/images/movies/the_shining.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `songs`
--

CREATE TABLE `songs` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `duration` int NOT NULL COMMENT 'Durée en secondes',
  `rating` int NOT NULL,
  `album_id` int DEFAULT NULL
) ;

--
-- Déchargement des données de la table `songs`
--

INSERT INTO `songs` (`id`, `title`, `duration`, `rating`, `album_id`) VALUES
(6, 'Bohemian Rhapsody', 355, 5, 4),
(7, 'Come Together', 260, 3, 1),
(8, 'Something', 183, 5, 1),
(9, 'Maxwell\'s Silver Hammer', 207, 4, 1),
(10, 'Oh! Darling', 206, 4, 1),
(11, 'Octopus\'s Garden', 171, 4, 1),
(12, 'I Want You (She\'s So Heavy)', 467, 5, 1),
(13, 'Here Comes the Sun', 185, 5, 1),
(14, 'Because', 165, 4, 1),
(15, 'You Never Give Me Your Money', 242, 5, 1),
(16, 'Sun King', 146, 4, 1),
(17, 'Mean Mr. Mustard', 66, 4, 1),
(18, 'Polythene Pam', 72, 4, 1),
(19, 'She Came In Through the Bathroom Window', 117, 4, 1),
(20, 'Golden Slumbers', 91, 5, 1),
(21, 'Carry That Weight', 96, 1, 1),
(22, 'The End', 125, 5, 1),
(23, 'Her Majesty', 23, 3, 1),
(24, 'Speak to Me', 90, 4, 2),
(25, 'Breathe', 163, 5, 2),
(26, 'On the Run', 225, 4, 2),
(27, 'Time', 413, 5, 2),
(28, 'The Great Gig in the Sky', 284, 5, 2),
(29, 'Money', 382, 2, 2),
(30, 'Us and Them', 469, 5, 2),
(31, 'Any Colour You Like', 206, 4, 2),
(32, 'Brain Damage', 230, 5, 2),
(33, 'Eclipse', 132, 4, 2),
(34, 'Wanna Be Startin\' Somethin\'', 363, 5, 3),
(35, 'Baby Be Mine', 260, 4, 3),
(36, 'The Girl Is Mine', 222, 4, 3),
(37, 'Thriller', 357, 5, 3),
(38, 'Beat It', 258, 5, 3),
(39, 'Billie Jean', 294, 5, 3),
(40, 'Human Nature', 246, 5, 3),
(41, 'P.Y.T. (Pretty Young Thing)', 239, 4, 3),
(42, 'The Lady in My Life', 299, 4, 3),
(43, 'Death on Two Legs', 223, 4, 4),
(44, 'Lazing on a Sunday Afternoon', 68, 4, 4),
(45, 'I\'m in Love with My Car', 185, 4, 4),
(46, 'You\'re My Best Friend', 170, 5, 4),
(47, '\'39', 210, 4, 4),
(48, 'Sweet Lady', 241, 4, 4),
(49, 'Seaside Rendezvous', 135, 4, 4),
(50, 'The Prophet\'s Song', 501, 5, 4),
(51, 'Love of My Life', 218, 5, 4),
(52, 'Good Company', 203, 4, 4),
(53, 'God Save the Queen', 75, 3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `album_id` (`album_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

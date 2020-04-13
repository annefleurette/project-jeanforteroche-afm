-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  lun. 13 avr. 2020 à 16:51
-- Version du serveur :  5.7.26
-- Version de PHP :  7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `novel`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_episode` int(11) NOT NULL,
  `id_pseudo` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_comment` datetime NOT NULL,
  `alert` varchar(255) NOT NULL DEFAULT 'non'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `id_episode`, `id_pseudo`, `comment`, `date_comment`, `alert`) VALUES
(1, 39, 14, 'J\'adore cet épisode ! Super intrigue !', '2020-04-13 16:04:14', 'non'),
(2, 39, 9, 'Merci lecteurtest pour ton retour ;)', '2020-04-13 16:04:42', 'non'),
(3, 46, 14, 'Bouh !', '2020-04-13 16:05:30', 'oui');

-- --------------------------------------------------------

--
-- Structure de la table `episodes`
--

CREATE TABLE `episodes` (
  `id` int(11) NOT NULL,
  `episode_number` int(11) NOT NULL,
  `episode_title` varchar(255) NOT NULL,
  `episode_content` text NOT NULL,
  `episode_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `episodes`
--

INSERT INTO `episodes` (`id`, `episode_number`, `episode_title`, `episode_content`, `episode_status`) VALUES
(39, 1, 'Le grand départ', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla luctus arcu ac ex dapibus interdum. Donec sed blandit nunc. Donec sollicitudin tincidunt augue, ut efficitur nisi. Aenean est ligula, cursus finibus libero non, sagittis finibus ipsum. Sed pharetra id massa feugiat porttitor. Mauris a lobortis risus. Pellentesque pharetra metus turpis, a porta dolor scelerisque eu. Aliquam at consectetur arcu. Fusce ultricies, nisi id rutrum eleifend, diam arcu imperdiet purus, nec malesuada odio massa nec augue.</span></p>', 'published'),
(46, 2, 'Matinée ensoleillée', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">Sed sodales diam erat, et convallis libero dictum sed. Nam sodales luctus luctus. Etiam dictum nisl magna, in malesuada nisi suscipit in. Nullam nec vestibulum nunc. Proin aliquet ultricies ante eu sagittis. Quisque feugiat dignissim ex, ac sodales ligula gravida quis. Duis quis nisl ex. Curabitur pharetra neque id vehicula euismod. Aliquam tincidunt in libero placerat sodales. Nunc ultrices velit sit amet erat feugiat, ac ornare dolor lobortis.</span></p>', 'published'),
(50, 3, 'Après-midi à l\'ombre', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">Vivamus quis feugiat metus. Proin vel tellus in magna hendrerit sagittis non eu sapien. Nunc ex dui, vehicula et pretium vel, luctus at sapien. Nulla pharetra metus erat, ut convallis nibh iaculis nec. Duis elementum euismod felis sed fringilla. Sed eros mi, ultrices ac nunc ut, maximus dapibus dui. Ut in est et nisl euismod aliquam.</span></p>', 'published'),
(52, 4, 'Goûter pluvieux', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">In egestas odio at ultricies porta. Nulla viverra consectetur purus ut pretium. Morbi non nisi finibus, efficitur magna sit amet, sodales justo. Vestibulum non ligula et tellus viverra maximus porta in ligula. Pellentesque rhoncus suscipit pellentesque. Nulla eu fringilla velit. In vel ex ac lacus tempus imperdiet. Aliquam at mauris neque. Aenean arcu lectus, accumsan convallis ante vel, malesuada feugiat mi. Sed ac congue ipsum, ut venenatis purus. Nulla vel elementum mauris. Vestibulum dignissim et urna quis finibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras nec facilisis arcu.</span></p>', 'inprogress'),
(53, 5, 'Soirée hivernale', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">Donec mattis imperdiet lorem quis commodo. Fusce et commodo leo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Morbi bibendum eget libero quis tempor. In hac habitasse platea dictumst. Donec interdum eros ut arcu feugiat, quis mattis leo mollis. Suspendisse pellentesque quam ac mi elementum pulvinar.</span></p>', 'inprogress');

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_subscription` date NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`id`, `pseudo`, `password`, `email`, `date_subscription`, `type`) VALUES
(9, 'jeanforteroche', '$2y$10$OG5L3o1I26hoKFQohJqpHOK41Cbai7EqvvADtzmzBK09mo3eJcmG.', 'af.marchat@gmail.com', '2020-04-11', 'admin'),
(14, 'lecteurtest', '$2y$10$5U7QomZjoAutgUtNCfOj..Qk9qHdq2xVuxrG2EpN34uwKt41cxc2i', 'marchat.af@gmail.com', '2020-04-12', 'reader');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`id_pseudo`),
  ADD KEY `FK_comments_episode` (`id_episode`);

--
-- Index pour la table `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_comments_episode` FOREIGN KEY (`id_episode`) REFERENCES `episodes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_comments_member` FOREIGN KEY (`id_pseudo`) REFERENCES `members` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

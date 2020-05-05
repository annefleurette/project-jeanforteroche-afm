-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  mar. 05 mai 2020 à 12:14
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
(2, 62, 14, 'J\'adore le début du roman ! Que de suspens !', '2020-04-20 17:36:59', 'non'),
(3, 62, 9, 'Merci pour ton retour ! J\'espère que la suite te plaira tout autant :)', '2020-04-20 17:37:32', 'non'),
(4, 62, 15, 'bluuuuuuurg', '2020-04-20 17:38:49', 'oui'),
(5, 63, 9, 'J\'espère que cet épisode vous plaira !', '2020-04-24 12:45:49', 'non'),
(7, 63, 9, 'Alors ?', '2020-04-24 12:47:58', 'non'),
(8, 63, 14, 'J\'adore !', '2020-04-28 11:07:55', 'non'),
(10, 62, 15, 'bouhhhhhhhhh', '2020-05-04 10:37:19', 'non');

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
(62, 1, 'Le grand départ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce et tortor consectetur nulla rhoncus fermentum non vel nunc. Maecenas in risus vel felis consequat varius. Vestibulum in pellentesque massa. Aliquam nisl sem, iaculis in aliquet eu, gravida eu urna. Nulla at ipsum diam. Nulla at fringilla tortor, ut consequat ligula. Cras iaculis nec dolor vitae pretium. Phasellus cursus iaculis hendrerit. Nulla magna nisi, pretium vel bibendum a, gravida in metus. Integer sit amet felis enim. Cras massa ex, sodales at suscipit posuere, rhoncus et dolor. Nunc mollis, metus eu fermentum bibendum, ante dui condimentum enim, in cursus dolor enim sed eros. Nulla ut iaculis odio.', 'published'),
(63, 2, 'Matinée ensoleillée', 'Suspendisse sit amet suscipit sem, vitae feugiat orci. Pellentesque vitae sapien dictum, posuere ipsum at, pulvinar lorem. In hac habitasse platea dictumst. Nam ac egestas magna, eget malesuada tortor. Etiam consequat orci auctor magna aliquam rhoncus. Integer sodales malesuada viverra. Sed ullamcorper ornare enim. Pellentesque interdum placerat eros, eu elementum libero mattis eu. Praesent sit amet sollicitudin magna, nec blandit nisi. Phasellus sit amet iaculis lacus. Fusce vulputate, leo nec bibendum consectetur, metus velit tincidunt enim, eu malesuada erat augue elementum dui. Sed condimentum tincidunt massa. Proin placerat laoreet dolor, sit amet malesuada lectus venenatis eget.', 'published'),
(64, 3, 'Après-midi sous le vent', 'Nulla facilisi. Sed efficitur sem eu magna maximus, quis vestibulum nulla elementum. Morbi neque ligula, vestibulum in imperdiet in, suscipit tincidunt tellus. Nullam semper non purus sit amet placerat. Ut faucibus ullamcorper mi in mollis. Maecenas iaculis est ipsum, non luctus odio euismod non. Quisque lacinia lacus malesuada maximus dapibus. Proin viverra ante eu orci volutpat luctus. Vestibulum maximus vitae odio at pretium. Nulla ex nulla, ornare eget sodales ut, rutrum eu turpis.', 'published'),
(69, 4, 'Goûter pluvieux', 'Proin venenatis auctor purus a viverra. Donec efficitur faucibus mattis. Cras cursus, velit ut sagittis porta, ex nisl tincidunt arcu, vel scelerisque diam metus non nisl. Duis eget massa dolor. Mauris mollis urna quis urna tristique, gravida eleifend nisl aliquet. Suspendisse vitae finibus sem, eget dapibus neque. Aliquam dignissim tempus faucibus. Etiam sed neque est. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras finibus, augue non vehicula semper, ex nunc semper nulla, in pulvinar dui ante vitae nibh. Nam lacinia porta luctus. Etiam varius sed lacus ac pharetra. Sed accumsan neque est, a tempor nunc bibendum eu. Aliquam cursus justo sit amet elit gravida, suscipit sagittis eros semper.', 'published'),
(70, 5, 'Soirée hivernale', 'Praesent risus lacus, tristique vel est vel, maximus laoreet leo. Quisque ut purus nibh. Cras semper, neque sed consequat pretium, sem nisi interdum arcu, et fermentum nulla nisl id diam. Praesent congue auctor risus rutrum ultrices. Proin magna odio, semper quis risus sed, posuere consequat ex. Pellentesque odio urna, maximus iaculis mauris et, mollis vehicula dolor. Etiam laoreet augue metus, sit amet iaculis sapien sollicitudin et. Sed id leo a orci pulvinar lacinia. Duis ante lectus, malesuada at porttitor vitae, laoreet id turpis.', 'inprogress');

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
(14, 'lecteurtest', '$2y$10$5U7QomZjoAutgUtNCfOj..Qk9qHdq2xVuxrG2EpN34uwKt41cxc2i', 'marchat.af@gmail.com', '2020-04-12', 'reader'),
(15, 'lecteurbizarre', '$2y$10$NXw.X4AScKpL4EctTJ5Gt.e3BeQocvL/SxgtpcWR4BMUw7K/AHJ66', 'anne-fleur.marchat@laposte.net', '2020-04-20', 'reader');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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

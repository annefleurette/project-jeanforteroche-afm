-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  lun. 20 avr. 2020 à 15:50
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
(4, 62, 15, 'bluuuuuuurg', '2020-04-20 17:38:49', 'oui');

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
(62, 1, 'Le grand départ', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce et tortor consectetur nulla rhoncus fermentum non vel nunc. Maecenas in risus vel felis consequat varius. Vestibulum in pellentesque massa. Aliquam nisl sem, iaculis in aliquet eu, gravida eu urna. Nulla at ipsum diam. Nulla at fringilla tortor, ut consequat ligula. Cras iaculis nec dolor vitae pretium. Phasellus cursus iaculis hendrerit. Nulla magna nisi, pretium vel bibendum a, gravida in metus. Integer sit amet felis enim. Cras massa ex, sodales at suscipit posuere, rhoncus et dolor. Nunc mollis, metus eu fermentum bibendum, ante dui condimentum enim, in cursus dolor enim sed eros. Nulla ut iaculis odio.</span></p>', 'published'),
(63, 2, 'Matinée ensoleillée', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">Suspendisse sit amet suscipit sem, vitae feugiat orci. Pellentesque vitae sapien dictum, posuere ipsum at, pulvinar lorem. In hac habitasse platea dictumst. Nam ac egestas magna, eget malesuada tortor. Etiam consequat orci auctor magna aliquam rhoncus. Integer sodales malesuada viverra. Sed ullamcorper ornare enim. Pellentesque interdum placerat eros, eu elementum libero mattis eu. Praesent sit amet sollicitudin magna, nec blandit nisi. Phasellus sit amet iaculis lacus. Fusce vulputate, leo nec bibendum consectetur, metus velit tincidunt enim, eu malesuada erat augue elementum dui. Sed condimentum tincidunt massa. Proin placerat laoreet dolor, sit amet malesuada lectus venenatis eget.</span></p>', 'published'),
(64, 3, 'Après-midi sous le vent', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">Nulla facilisi. Sed efficitur sem eu magna maximus, quis vestibulum nulla elementum. Morbi neque ligula, vestibulum in imperdiet in, suscipit tincidunt tellus. Nullam semper non purus sit amet placerat. Ut faucibus ullamcorper mi in mollis. Maecenas iaculis est ipsum, non luctus odio euismod non. Quisque lacinia lacus malesuada maximus dapibus. Proin viverra ante eu orci volutpat luctus. Vestibulum maximus vitae odio at pretium. Nulla ex nulla, ornare eget sodales ut, rutrum eu turpis.</span></p>', 'published'),
(65, 4, 'Soirée hivernale', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">Praesent nec aliquet tortor. Aenean condimentum ante eget ante dignissim sagittis. Vestibulum maximus ex quis erat ornare, sed aliquam est tincidunt. Morbi quis magna lobortis, volutpat est vel, feugiat nisl. Maecenas elementum facilisis tempus. Sed rutrum tincidunt sapien, eu luctus odio ornare a. Nunc ut est non nunc laoreet porta. Suspendisse gravida bibendum tincidunt. Morbi leo nunc, maximus vel luctus eu, sagittis id dolor. Morbi diam nisl, dignissim vel risus tempor, luctus efficitur arcu.</span></p>', 'published'),
(68, 5, 'Nuit glaciale', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">Fusce feugiat orci vel libero elementum, ac volutpat velit fringilla. Fusce vel maximus elit. Vivamus porttitor non eros at imperdiet. Nam a eros sed felis porta gravida eu eget metus. Proin feugiat facilisis leo id gravida. Sed at lacus libero. Sed sollicitudin sit amet ligula eu euismod. Vivamus feugiat neque egestas turpis varius, vel convallis diam sollicitudin. Nam sit amet odio ut odio aliquam semper. Sed euismod lorem eu posuere pharetra. Fusce porttitor scelerisque turpis vel consequat. Curabitur quis elit sit amet augue porta imperdiet. Sed pharetra pulvinar mauris et malesuada. Mauris sagittis urna volutpat mattis ultrices. Morbi iaculis posuere urna, eget sodales tellus sollicitudin vitae.</span></p>', 'inprogress');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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

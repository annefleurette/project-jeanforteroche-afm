-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  lun. 06 avr. 2020 à 20:44
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
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `date_comment` datetime NOT NULL,
  `alert` varchar(255) NOT NULL DEFAULT 'non'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `id_episode`, `author`, `comment`, `date_comment`, `alert`) VALUES
(10, 1, 'Julien', 'Au top cet épisode !', '2020-04-05 18:05:21', 'non'),
(11, 1, 'Marie', 'J\'adore le début de l\'histoire', '2020-04-05 18:34:32', 'non'),
(12, 2, 'Marie', 'J\'adore l\'intrigue', '2020-04-05 21:49:21', 'oui'),
(13, 2, 'Tom', 'Whaou !', '2020-04-06 19:08:00', 'non'),
(14, 3, 'Julien', 'J\'adore l\'histoire !', '2020-04-06 21:25:33', 'non');

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
(17, 1, 'Le grand départ vers le nord', '&lt;p class=&quot;p1&quot; style=&quot;margin: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: \'Helvetica Neue\';&quot;&gt;&lt;span style=&quot;font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;&quot;&gt;Etiam hendrerit vulputate urna sit amet bibendum. Nullam vitae urna sed purus ultricies vulputate. Pellentesque id volutpat neque. Nulla consequat tincidunt augue, ut hendrerit orci aliquam vitae. Mauris ullamcorper condimentum pellentesque. Cras ac molestie arcu. In fringilla velit in erat aliquet, eget tincidunt lectus pretium. Vestibulum egestas sed magna non hendrerit. Curabitur ultrices, leo quis mollis egestas, libero odio commodo elit, et ultricies felis felis vitae eros. Donec sollicitudin eleifend felis ut efficitur. Fusce eget est sit amet augue dictum aliquet sit amet vel leo. Pellentesque dictum, elit ac fermentum rutrum, metus nunc feugiat justo, in pharetra arcu ante vel arcu. Etiam risus libero, imperdiet a semper eu, iaculis sit amet diam. Etiam nisl diam, consequat eget commodo a, elementum ut leo. In erat ante, vestibulum a turpis sit amet, cursus vestibulum ligula. Integer vitae ante sit amet orci finibus sagittis ac eu erat.&lt;/span&gt;&lt;/p&gt;', 'published'),
(21, 2, 'Promenade à l\'aube', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">Nullam mattis non felis in pellentesque. Vivamus nulla velit, consectetur quis ultrices eget, dignissim ac ligula. Morbi a arcu egestas, maximus velit id, malesuada dolor. Donec pulvinar in sem vitae tincidunt. Vestibulum rutrum est vel augue commodo malesuada. Suspendisse sed molestie diam. Suspendisse eget malesuada diam. Praesent nec urna eu orci ultricies commodo sed quis nisl.</span></p>', 'published'),
(23, 3, 'Déjeuner sur l\'herbe', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer auctor diam ac mauris lacinia, ac porttitor est pharetra. Donec eu venenatis justo. Nullam venenatis vulputate eros nec dictum. Curabitur porttitor lacus vestibulum libero laoreet suscipit. Aliquam porttitor sit amet ex in volutpat. Pellentesque est urna, iaculis at eros eu, interdum mollis libero. Proin commodo mauris id massa faucibus facilisis. Nulla ut nulla lacinia, ultricies turpis placerat, congue lorem. Etiam pellentesque ornare elit ac consectetur. Duis cursus molestie feugiat. Quisque ornare justo nibh, at dapibus justo vulputate in. Fusce odio purus, feugiat non posuere id, suscipit a magna. Morbi lobortis luctus tellus. Vivamus a rutrum est.</span></p>', 'published'),
(24, 4, 'Après-midi au soleil', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">Etiam hendrerit vulputate urna sit amet bibendum. Nullam vitae urna sed purus ultricies vulputate. Pellentesque id volutpat neque. Nulla consequat tincidunt augue, ut hendrerit orci aliquam vitae. Mauris ullamcorper condimentum pellentesque. Cras ac molestie arcu. In fringilla velit in erat aliquet, eget tincidunt lectus pretium. Vestibulum egestas sed magna non hendrerit. Curabitur ultrices, leo quis mollis egestas, libero odio commodo elit, et ultricies felis felis vitae eros. Donec sollicitudin eleifend felis ut efficitur. Fusce eget est sit amet augue dictum aliquet sit amet vel leo. Pellentesque dictum, elit ac fermentum rutrum, metus nunc feugiat justo, in pharetra arcu ante vel arcu. Etiam risus libero, imperdiet a semper eu, iaculis sit amet diam. Etiam nisl diam, consequat eget commodo a, elementum ut leo. In erat ante, vestibulum a turpis sit amet, cursus vestibulum ligula. Integer vitae ante sit amet orci finibus sagittis ac eu erat.</span></p>', 'published'),
(25, 5, 'Goûter pluvieux', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">Etiam hendrerit vulputate urna sit amet bibendum. Nullam vitae urna sed purus ultricies vulputate. Pellentesque id volutpat neque. Nulla consequat tincidunt augue, ut hendrerit orci aliquam vitae. Mauris ullamcorper condimentum pellentesque. Cras ac molestie arcu. In fringilla velit in erat aliquet, eget tincidunt lectus pretium. Vestibulum egestas sed magna non hendrerit. Curabitur ultrices, leo quis mollis egestas, libero odio commodo elit, et ultricies felis felis vitae eros. Donec sollicitudin eleifend felis ut efficitur. Fusce eget est sit amet augue dictum aliquet sit amet vel leo. Pellentesque dictum, elit ac fermentum rutrum, metus nunc feugiat justo, in pharetra arcu ante vel arcu. Etiam risus libero, imperdiet a semper eu, iaculis sit amet diam. Etiam nisl diam, consequat eget commodo a, elementum ut leo. In erat ante, vestibulum a turpis sit amet, cursus vestibulum ligula. Integer vitae ante sit amet orci finibus sagittis ac eu erat.</span></p>', 'published'),
(26, 6, 'Soirée hivernale', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">Nullam mattis non felis in pellentesque. Vivamus nulla velit, consectetur quis ultrices eget, dignissim ac ligula. Morbi a arcu egestas, maximus velit id, malesuada dolor. Donec pulvinar in sem vitae tincidunt. Vestibulum rutrum est vel augue commodo malesuada. Suspendisse sed molestie diam. Suspendisse eget malesuada diam. Praesent nec urna eu orci ultricies commodo sed quis nisl.</span></p>', 'published'),
(27, 7, 'Nuit glaciale', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">Vestibulum ut lacus justo. Vestibulum ac molestie arcu, ac cursus ipsum. Donec consequat blandit lacus eu hendrerit. Nullam imperdiet volutpat mauris, faucibus scelerisque odio scelerisque eu. In et ex eros. Cras commodo, quam et cursus consectetur, lacus neque ultricies augue, eget dictum nibh purus sit amet ipsum. Duis eget felis feugiat, vehicula tellus et, suscipit ex. Integer lobortis efficitur ullamcorper. Sed sit amet imperdiet ex. Aliquam aliquam pulvinar est, vitae consequat dolor vestibulum sed. Aenean lobortis ex vel magna fermentum sodales. Donec eget odio ac nisl ornare lacinia.</span></p>', 'published'),
(28, 8, 'Aube insolite', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">Vestibulum ut lacus justo. Vestibulum ac molestie arcu, ac cursus ipsum. Donec consequat blandit lacus eu hendrerit. Nullam imperdiet volutpat mauris, faucibus scelerisque odio scelerisque eu. In et ex eros. Cras commodo, quam et cursus consectetur, lacus neque ultricies augue, eget dictum nibh purus sit amet ipsum. Duis eget felis feugiat, vehicula tellus et, suscipit ex. Integer lobortis efficitur ullamcorper. Sed sit amet imperdiet ex. Aliquam aliquam pulvinar est, vitae consequat dolor vestibulum sed. Aenean lobortis ex vel magna fermentum sodales. Donec eget odio ac nisl ornare lacinia.</span></p>', 'published'),
(29, 9, 'Matinée à la fraîche', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">Vestibulum ut lacus justo. Vestibulum ac molestie arcu, ac cursus ipsum. Donec consequat blandit lacus eu hendrerit. Nullam imperdiet volutpat mauris, faucibus scelerisque odio scelerisque eu. In et ex eros. Cras commodo, quam et cursus consectetur, lacus neque ultricies augue, eget dictum nibh purus sit amet ipsum. Duis eget felis feugiat, vehicula tellus et, suscipit ex. Integer lobortis efficitur ullamcorper. Sed sit amet imperdiet ex. Aliquam aliquam pulvinar est, vitae consequat dolor vestibulum sed. Aenean lobortis ex vel magna fermentum sodales. Donec eget odio ac nisl ornare lacinia.</span></p>', 'published'),
(30, 10, 'Déjeuner au sommet', '&lt;p&gt;&lt;span style=&quot;font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;&quot;&gt;Vestibulum ut lacus justo. Vestibulum ac molestie arcu, ac cursus ipsum. Donec consequat blandit lacus eu hendrerit. Nullam imperdiet volutpat mauris, faucibus scelerisque odio scelerisque eu. In et ex eros. Cras commodo, quam et cursus consectetur, lacus neque ultricies augue, eget dictum nibh purus sit amet ipsum. Duis eget felis feugiat, vehicula tellus et, suscipit ex. Integer lobortis efficitur ullamcorper. Sed sit amet imperdiet ex. Aliquam aliquam pulvinar est, vitae consequat dolor vestibulum sed. Aenean lobortis ex vel magna fermentum sodales. Donec eget odio ac nisl ornare lacinia.&lt;/span&gt;&lt;/p&gt;', 'inprogress'),
(31, 11, 'Course du matin', '&lt;p&gt;&lt;span style=&quot;font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;&quot;&gt;Aliquam vestibulum, metus vitae gravida vehicula, metus nunc pharetra massa, quis viverra ante mauris non dolor. Aenean tellus magna, cursus sed vehicula ut, ullamcorper ut augue. Nullam in lorem hendrerit, gravida urna non, imperdiet mi. Mauris placerat fringilla sapien, vitae vestibulum ligula consequat in. Fusce eget semper augue. Nulla at eros a erat maximus faucibus non ut mauris. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc efficitur, diam eget ultrices vulputate, nulla enim tincidunt nisl, et consequat metus purus ut justo. Cras luctus posuere sem et accumsan. Sed a consequat tortor. Aenean et tellus tristique, mattis massa nec, ullamcorper nibh. Maecenas ac diam in nulla lacinia accumsan eu vel nibh. Integer congue, ipsum faucibus bibendum sagittis, ipsum lacus dapibus sapien, nec malesuada lectus purus at nisl. Maecenas odio dui, consectetur at libero a, consectetur sollicitudin ligula.&lt;/span&gt;&lt;/p&gt;', 'inprogress');

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
(1, 'jeanforteroche', 'nouveauroman', 'af.marchat@gmail.com', '2020-03-30', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

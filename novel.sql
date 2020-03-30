-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  lun. 30 mars 2020 à 20:43
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
  `date_comment` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `id_episode`, `author`, `comment`, `date_comment`) VALUES
(8, 3, 'Annie', 'J\'adore cet épisode', '2020-03-30 21:22:54');

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
(1, 1, 'Le départ vers le nord', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus at mauris gravida, eleifend diam eget, fringilla ex. Sed sit amet scelerisque orci. Morbi orci purus, pulvinar ut nunc id, fringilla lacinia odio. Donec rhoncus nisl ipsum, vitae tempus mauris finibus at. Praesent finibus nunc eros, et ultricies risus dignissim vel. Maecenas sed orci in nulla vulputate tristique. Duis vitae pellentesque nisl, ut vulputate magna. Pellentesque est ipsum, commodo sed varius venenatis, aliquam rutrum est. Praesent id vestibulum libero, quis feugiat ante. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi egestas, orci sit amet molestie malesuada, sapien mi eleifend nisl, eget suscipit neque nunc et eros. Aliquam ut cursus turpis, at posuere dolor.\r\n\r\nNullam in erat egestas, rhoncus magna sed, eleifend tellus. Suspendisse sit amet quam eu lectus luctus vulputate in ac lorem. Nunc vel elementum risus. Suspendisse quis diam tortor. Fusce laoreet nunc ac lorem porttitor commodo. Vivamus vitae nibh risus. Maecenas dignissim lorem ut libero ullamcorper, eget ornare risus consequat. Mauris venenatis convallis viverra. Sed eros ipsum, rhoncus eget consequat a, varius non odio. Nam semper mauris vitae scelerisque suscipit. Nulla at metus ac urna aliquet egestas nec eu ligula.\r\n\r\nVestibulum volutpat, dui et commodo porta, nisi quam rutrum velit, nec pharetra nisl tellus non massa. In dignissim quis mi eget facilisis. Quisque blandit nisi leo, at feugiat urna elementum eu. Suspendisse scelerisque vehicula nisl, at consectetur felis sodales vulputate. Nulla sodales magna quis orci mattis iaculis nec a magna. Duis eget faucibus nisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque et justo ac velit rhoncus pulvinar.\r\n\r\nCras pulvinar leo ac auctor commodo. Vivamus quis nunc est. Etiam dapibus, enim at efficitur congue, turpis mi semper risus, sed interdum ligula lectus vel ipsum. Fusce sollicitudin elementum erat. Etiam sit amet arcu dui. Nullam ut erat egestas, fermentum erat a, aliquam augue. Nunc augue nunc, laoreet fermentum purus et, imperdiet iaculis justo. Donec id velit et dolor egestas condimentum. Sed vel ex ac sapien pharetra egestas.', 'published'),
(2, 2, 'Le départ vers le nord', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus at mauris gravida, eleifend diam eget, fringilla ex. Sed sit amet scelerisque orci. Morbi orci purus, pulvinar ut nunc id, fringilla lacinia odio. Donec rhoncus nisl ipsum, vitae tempus mauris finibus at. Praesent finibus nunc eros, et ultricies risus dignissim vel. Maecenas sed orci in nulla vulputate tristique. Duis vitae pellentesque nisl, ut vulputate magna. Pellentesque est ipsum, commodo sed varius venenatis, aliquam rutrum est. Praesent id vestibulum libero, quis feugiat ante. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi egestas, orci sit amet molestie malesuada, sapien mi eleifend nisl, eget suscipit neque nunc et eros. Aliquam ut cursus turpis, at posuere dolor.\r\n\r\nNullam in erat egestas, rhoncus magna sed, eleifend tellus. Suspendisse sit amet quam eu lectus luctus vulputate in ac lorem. Nunc vel elementum risus. Suspendisse quis diam tortor. Fusce laoreet nunc ac lorem porttitor commodo. Vivamus vitae nibh risus. Maecenas dignissim lorem ut libero ullamcorper, eget ornare risus consequat. Mauris venenatis convallis viverra. Sed eros ipsum, rhoncus eget consequat a, varius non odio. Nam semper mauris vitae scelerisque suscipit. Nulla at metus ac urna aliquet egestas nec eu ligula.\r\n\r\nVestibulum volutpat, dui et commodo porta, nisi quam rutrum velit, nec pharetra nisl tellus non massa. In dignissim quis mi eget facilisis. Quisque blandit nisi leo, at feugiat urna elementum eu. Suspendisse scelerisque vehicula nisl, at consectetur felis sodales vulputate. Nulla sodales magna quis orci mattis iaculis nec a magna. Duis eget faucibus nisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque et justo ac velit rhoncus pulvinar.\r\n\r\nCras pulvinar leo ac auctor commodo. Vivamus quis nunc est. Etiam dapibus, enim at efficitur congue, turpis mi semper risus, sed interdum ligula lectus vel ipsum. Fusce sollicitudin elementum erat. Etiam sit amet arcu dui. Nullam ut erat egestas, fermentum erat a, aliquam augue. Nunc augue nunc, laoreet fermentum purus et, imperdiet iaculis justo. Donec id velit et dolor egestas condimentum. Sed vel ex ac sapien pharetra egestas.', 'published'),
(3, 3, 'Le départ vers le nord', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus at mauris gravida, eleifend diam eget, fringilla ex. Sed sit amet scelerisque orci. Morbi orci purus, pulvinar ut nunc id, fringilla lacinia odio. Donec rhoncus nisl ipsum, vitae tempus mauris finibus at. Praesent finibus nunc eros, et ultricies risus dignissim vel. Maecenas sed orci in nulla vulputate tristique. Duis vitae pellentesque nisl, ut vulputate magna. Pellentesque est ipsum, commodo sed varius venenatis, aliquam rutrum est. Praesent id vestibulum libero, quis feugiat ante. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi egestas, orci sit amet molestie malesuada, sapien mi eleifend nisl, eget suscipit neque nunc et eros. Aliquam ut cursus turpis, at posuere dolor.\r\n\r\nNullam in erat egestas, rhoncus magna sed, eleifend tellus. Suspendisse sit amet quam eu lectus luctus vulputate in ac lorem. Nunc vel elementum risus. Suspendisse quis diam tortor. Fusce laoreet nunc ac lorem porttitor commodo. Vivamus vitae nibh risus. Maecenas dignissim lorem ut libero ullamcorper, eget ornare risus consequat. Mauris venenatis convallis viverra. Sed eros ipsum, rhoncus eget consequat a, varius non odio. Nam semper mauris vitae scelerisque suscipit. Nulla at metus ac urna aliquet egestas nec eu ligula.\r\n\r\nVestibulum volutpat, dui et commodo porta, nisi quam rutrum velit, nec pharetra nisl tellus non massa. In dignissim quis mi eget facilisis. Quisque blandit nisi leo, at feugiat urna elementum eu. Suspendisse scelerisque vehicula nisl, at consectetur felis sodales vulputate. Nulla sodales magna quis orci mattis iaculis nec a magna. Duis eget faucibus nisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque et justo ac velit rhoncus pulvinar.\r\n\r\nCras pulvinar leo ac auctor commodo. Vivamus quis nunc est. Etiam dapibus, enim at efficitur congue, turpis mi semper risus, sed interdum ligula lectus vel ipsum. Fusce sollicitudin elementum erat. Etiam sit amet arcu dui. Nullam ut erat egestas, fermentum erat a, aliquam augue. Nunc augue nunc, laoreet fermentum purus et, imperdiet iaculis justo. Donec id velit et dolor egestas condimentum. Sed vel ex ac sapien pharetra egestas.', 'published'),
(4, 4, 'Le départ vers le nord', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus at mauris gravida, eleifend diam eget, fringilla ex. Sed sit amet scelerisque orci. Morbi orci purus, pulvinar ut nunc id, fringilla lacinia odio. Donec rhoncus nisl ipsum, vitae tempus mauris finibus at. Praesent finibus nunc eros, et ultricies risus dignissim vel. Maecenas sed orci in nulla vulputate tristique. Duis vitae pellentesque nisl, ut vulputate magna. Pellentesque est ipsum, commodo sed varius venenatis, aliquam rutrum est. Praesent id vestibulum libero, quis feugiat ante. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi egestas, orci sit amet molestie malesuada, sapien mi eleifend nisl, eget suscipit neque nunc et eros. Aliquam ut cursus turpis, at posuere dolor.\r\n\r\nNullam in erat egestas, rhoncus magna sed, eleifend tellus. Suspendisse sit amet quam eu lectus luctus vulputate in ac lorem. Nunc vel elementum risus. Suspendisse quis diam tortor. Fusce laoreet nunc ac lorem porttitor commodo. Vivamus vitae nibh risus. Maecenas dignissim lorem ut libero ullamcorper, eget ornare risus consequat. Mauris venenatis convallis viverra. Sed eros ipsum, rhoncus eget consequat a, varius non odio. Nam semper mauris vitae scelerisque suscipit. Nulla at metus ac urna aliquet egestas nec eu ligula.\r\n\r\nVestibulum volutpat, dui et commodo porta, nisi quam rutrum velit, nec pharetra nisl tellus non massa. In dignissim quis mi eget facilisis. Quisque blandit nisi leo, at feugiat urna elementum eu. Suspendisse scelerisque vehicula nisl, at consectetur felis sodales vulputate. Nulla sodales magna quis orci mattis iaculis nec a magna. Duis eget faucibus nisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque et justo ac velit rhoncus pulvinar.\r\n\r\nCras pulvinar leo ac auctor commodo. Vivamus quis nunc est. Etiam dapibus, enim at efficitur congue, turpis mi semper risus, sed interdum ligula lectus vel ipsum. Fusce sollicitudin elementum erat. Etiam sit amet arcu dui. Nullam ut erat egestas, fermentum erat a, aliquam augue. Nunc augue nunc, laoreet fermentum purus et, imperdiet iaculis justo. Donec id velit et dolor egestas condimentum. Sed vel ex ac sapien pharetra egestas.', 'published'),
(5, 5, 'Le départ vers le nord', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus at mauris gravida, eleifend diam eget, fringilla ex. Sed sit amet scelerisque orci. Morbi orci purus, pulvinar ut nunc id, fringilla lacinia odio. Donec rhoncus nisl ipsum, vitae tempus mauris finibus at. Praesent finibus nunc eros, et ultricies risus dignissim vel. Maecenas sed orci in nulla vulputate tristique. Duis vitae pellentesque nisl, ut vulputate magna. Pellentesque est ipsum, commodo sed varius venenatis, aliquam rutrum est. Praesent id vestibulum libero, quis feugiat ante. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi egestas, orci sit amet molestie malesuada, sapien mi eleifend nisl, eget suscipit neque nunc et eros. Aliquam ut cursus turpis, at posuere dolor.\r\n\r\nNullam in erat egestas, rhoncus magna sed, eleifend tellus. Suspendisse sit amet quam eu lectus luctus vulputate in ac lorem. Nunc vel elementum risus. Suspendisse quis diam tortor. Fusce laoreet nunc ac lorem porttitor commodo. Vivamus vitae nibh risus. Maecenas dignissim lorem ut libero ullamcorper, eget ornare risus consequat. Mauris venenatis convallis viverra. Sed eros ipsum, rhoncus eget consequat a, varius non odio. Nam semper mauris vitae scelerisque suscipit. Nulla at metus ac urna aliquet egestas nec eu ligula.\r\n\r\nVestibulum volutpat, dui et commodo porta, nisi quam rutrum velit, nec pharetra nisl tellus non massa. In dignissim quis mi eget facilisis. Quisque blandit nisi leo, at feugiat urna elementum eu. Suspendisse scelerisque vehicula nisl, at consectetur felis sodales vulputate. Nulla sodales magna quis orci mattis iaculis nec a magna. Duis eget faucibus nisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque et justo ac velit rhoncus pulvinar.\r\n\r\nCras pulvinar leo ac auctor commodo. Vivamus quis nunc est. Etiam dapibus, enim at efficitur congue, turpis mi semper risus, sed interdum ligula lectus vel ipsum. Fusce sollicitudin elementum erat. Etiam sit amet arcu dui. Nullam ut erat egestas, fermentum erat a, aliquam augue. Nunc augue nunc, laoreet fermentum purus et, imperdiet iaculis justo. Donec id velit et dolor egestas condimentum. Sed vel ex ac sapien pharetra egestas.', 'published'),
(6, 6, 'Le départ vers le nord', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus at mauris gravida, eleifend diam eget, fringilla ex. Sed sit amet scelerisque orci. Morbi orci purus, pulvinar ut nunc id, fringilla lacinia odio. Donec rhoncus nisl ipsum, vitae tempus mauris finibus at. Praesent finibus nunc eros, et ultricies risus dignissim vel. Maecenas sed orci in nulla vulputate tristique. Duis vitae pellentesque nisl, ut vulputate magna. Pellentesque est ipsum, commodo sed varius venenatis, aliquam rutrum est. Praesent id vestibulum libero, quis feugiat ante. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi egestas, orci sit amet molestie malesuada, sapien mi eleifend nisl, eget suscipit neque nunc et eros. Aliquam ut cursus turpis, at posuere dolor.\r\n\r\nNullam in erat egestas, rhoncus magna sed, eleifend tellus. Suspendisse sit amet quam eu lectus luctus vulputate in ac lorem. Nunc vel elementum risus. Suspendisse quis diam tortor. Fusce laoreet nunc ac lorem porttitor commodo. Vivamus vitae nibh risus. Maecenas dignissim lorem ut libero ullamcorper, eget ornare risus consequat. Mauris venenatis convallis viverra. Sed eros ipsum, rhoncus eget consequat a, varius non odio. Nam semper mauris vitae scelerisque suscipit. Nulla at metus ac urna aliquet egestas nec eu ligula.\r\n\r\nVestibulum volutpat, dui et commodo porta, nisi quam rutrum velit, nec pharetra nisl tellus non massa. In dignissim quis mi eget facilisis. Quisque blandit nisi leo, at feugiat urna elementum eu. Suspendisse scelerisque vehicula nisl, at consectetur felis sodales vulputate. Nulla sodales magna quis orci mattis iaculis nec a magna. Duis eget faucibus nisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque et justo ac velit rhoncus pulvinar.\r\n\r\nCras pulvinar leo ac auctor commodo. Vivamus quis nunc est. Etiam dapibus, enim at efficitur congue, turpis mi semper risus, sed interdum ligula lectus vel ipsum. Fusce sollicitudin elementum erat. Etiam sit amet arcu dui. Nullam ut erat egestas, fermentum erat a, aliquam augue. Nunc augue nunc, laoreet fermentum purus et, imperdiet iaculis justo. Donec id velit et dolor egestas condimentum. Sed vel ex ac sapien pharetra egestas.', 'published'),
(8, 10, 'Le départ vers le nord', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus at mauris gravida, eleifend diam eget, fringilla ex. Sed sit amet scelerisque orci. Morbi orci purus, pulvinar ut nunc id, fringilla lacinia odio. Donec rhoncus nisl ipsum, vitae tempus mauris finibus at. Praesent finibus nunc eros, et ultricies risus dignissim vel. Maecenas sed orci in nulla vulputate tristique. Duis vitae pellentesque nisl, ut vulputate magna. Pellentesque est ipsum, commodo sed varius venenatis, aliquam rutrum est. Praesent id vestibulum libero, quis feugiat ante. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi egestas, orci sit amet molestie malesuada, sapien mi eleifend nisl, eget suscipit neque nunc et eros. Aliquam ut cursus turpis, at posuere dolor.\r\n\r\nNullam in erat egestas, rhoncus magna sed, eleifend tellus. Suspendisse sit amet quam eu lectus luctus vulputate in ac lorem. Nunc vel elementum risus. Suspendisse quis diam tortor. Fusce laoreet nunc ac lorem porttitor commodo. Vivamus vitae nibh risus. Maecenas dignissim lorem ut libero ullamcorper, eget ornare risus consequat. Mauris venenatis convallis viverra. Sed eros ipsum, rhoncus eget consequat a, varius non odio. Nam semper mauris vitae scelerisque suscipit. Nulla at metus ac urna aliquet egestas nec eu ligula.\r\n\r\nVestibulum volutpat, dui et commodo porta, nisi quam rutrum velit, nec pharetra nisl tellus non massa. In dignissim quis mi eget facilisis. Quisque blandit nisi leo, at feugiat urna elementum eu. Suspendisse scelerisque vehicula nisl, at consectetur felis sodales vulputate. Nulla sodales magna quis orci mattis iaculis nec a magna. Duis eget faucibus nisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque et justo ac velit rhoncus pulvinar.\r\n\r\nCras pulvinar leo ac auctor commodo. Vivamus quis nunc est. Etiam dapibus, enim at efficitur congue, turpis mi semper risus, sed interdum ligula lectus vel ipsum. Fusce sollicitudin elementum erat. Etiam sit amet arcu dui. Nullam ut erat egestas, fermentum erat a, aliquam augue. Nunc augue nunc, laoreet fermentum purus et, imperdiet iaculis justo. Donec id velit et dolor egestas condimentum. Sed vel ex ac sapien pharetra egestas.', 'inprogress'),
(9, 7, 'Le départ vers le nord', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus at mauris gravida, eleifend diam eget, fringilla ex. Sed sit amet scelerisque orci. Morbi orci purus, pulvinar ut nunc id, fringilla lacinia odio. Donec rhoncus nisl ipsum, vitae tempus mauris finibus at. Praesent finibus nunc eros, et ultricies risus dignissim vel. Maecenas sed orci in nulla vulputate tristique. Duis vitae pellentesque nisl, ut vulputate magna. Pellentesque est ipsum, commodo sed varius venenatis, aliquam rutrum est. Praesent id vestibulum libero, quis feugiat ante. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi egestas, orci sit amet molestie malesuada, sapien mi eleifend nisl, eget suscipit neque nunc et eros. Aliquam ut cursus turpis, at posuere dolor.\r\n\r\nNullam in erat egestas, rhoncus magna sed, eleifend tellus. Suspendisse sit amet quam eu lectus luctus vulputate in ac lorem. Nunc vel elementum risus. Suspendisse quis diam tortor. Fusce laoreet nunc ac lorem porttitor commodo. Vivamus vitae nibh risus. Maecenas dignissim lorem ut libero ullamcorper, eget ornare risus consequat. Mauris venenatis convallis viverra. Sed eros ipsum, rhoncus eget consequat a, varius non odio. Nam semper mauris vitae scelerisque suscipit. Nulla at metus ac urna aliquet egestas nec eu ligula.\r\n\r\nVestibulum volutpat, dui et commodo porta, nisi quam rutrum velit, nec pharetra nisl tellus non massa. In dignissim quis mi eget facilisis. Quisque blandit nisi leo, at feugiat urna elementum eu. Suspendisse scelerisque vehicula nisl, at consectetur felis sodales vulputate. Nulla sodales magna quis orci mattis iaculis nec a magna. Duis eget faucibus nisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque et justo ac velit rhoncus pulvinar.\r\n\r\nCras pulvinar leo ac auctor commodo. Vivamus quis nunc est. Etiam dapibus, enim at efficitur congue, turpis mi semper risus, sed interdum ligula lectus vel ipsum. Fusce sollicitudin elementum erat. Etiam sit amet arcu dui. Nullam ut erat egestas, fermentum erat a, aliquam augue. Nunc augue nunc, laoreet fermentum purus et, imperdiet iaculis justo. Donec id velit et dolor egestas condimentum. Sed vel ex ac sapien pharetra egestas.', 'published'),
(10, 8, 'Le départ vers le nord', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus at mauris gravida, eleifend diam eget, fringilla ex. Sed sit amet scelerisque orci. Morbi orci purus, pulvinar ut nunc id, fringilla lacinia odio. Donec rhoncus nisl ipsum, vitae tempus mauris finibus at. Praesent finibus nunc eros, et ultricies risus dignissim vel. Maecenas sed orci in nulla vulputate tristique. Duis vitae pellentesque nisl, ut vulputate magna. Pellentesque est ipsum, commodo sed varius venenatis, aliquam rutrum est. Praesent id vestibulum libero, quis feugiat ante. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi egestas, orci sit amet molestie malesuada, sapien mi eleifend nisl, eget suscipit neque nunc et eros. Aliquam ut cursus turpis, at posuere dolor.\r\n\r\nNullam in erat egestas, rhoncus magna sed, eleifend tellus. Suspendisse sit amet quam eu lectus luctus vulputate in ac lorem. Nunc vel elementum risus. Suspendisse quis diam tortor. Fusce laoreet nunc ac lorem porttitor commodo. Vivamus vitae nibh risus. Maecenas dignissim lorem ut libero ullamcorper, eget ornare risus consequat. Mauris venenatis convallis viverra. Sed eros ipsum, rhoncus eget consequat a, varius non odio. Nam semper mauris vitae scelerisque suscipit. Nulla at metus ac urna aliquet egestas nec eu ligula.\r\n\r\nVestibulum volutpat, dui et commodo porta, nisi quam rutrum velit, nec pharetra nisl tellus non massa. In dignissim quis mi eget facilisis. Quisque blandit nisi leo, at feugiat urna elementum eu. Suspendisse scelerisque vehicula nisl, at consectetur felis sodales vulputate. Nulla sodales magna quis orci mattis iaculis nec a magna. Duis eget faucibus nisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque et justo ac velit rhoncus pulvinar.\r\n\r\nCras pulvinar leo ac auctor commodo. Vivamus quis nunc est. Etiam dapibus, enim at efficitur congue, turpis mi semper risus, sed interdum ligula lectus vel ipsum. Fusce sollicitudin elementum erat. Etiam sit amet arcu dui. Nullam ut erat egestas, fermentum erat a, aliquam augue. Nunc augue nunc, laoreet fermentum purus et, imperdiet iaculis justo. Donec id velit et dolor egestas condimentum. Sed vel ex ac sapien pharetra egestas.', 'published'),
(11, 9, 'Le départ vers le nord', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus at mauris gravida, eleifend diam eget, fringilla ex. Sed sit amet scelerisque orci. Morbi orci purus, pulvinar ut nunc id, fringilla lacinia odio. Donec rhoncus nisl ipsum, vitae tempus mauris finibus at. Praesent finibus nunc eros, et ultricies risus dignissim vel. Maecenas sed orci in nulla vulputate tristique. Duis vitae pellentesque nisl, ut vulputate magna. Pellentesque est ipsum, commodo sed varius venenatis, aliquam rutrum est. Praesent id vestibulum libero, quis feugiat ante. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi egestas, orci sit amet molestie malesuada, sapien mi eleifend nisl, eget suscipit neque nunc et eros. Aliquam ut cursus turpis, at posuere dolor.\r\n\r\nNullam in erat egestas, rhoncus magna sed, eleifend tellus. Suspendisse sit amet quam eu lectus luctus vulputate in ac lorem. Nunc vel elementum risus. Suspendisse quis diam tortor. Fusce laoreet nunc ac lorem porttitor commodo. Vivamus vitae nibh risus. Maecenas dignissim lorem ut libero ullamcorper, eget ornare risus consequat. Mauris venenatis convallis viverra. Sed eros ipsum, rhoncus eget consequat a, varius non odio. Nam semper mauris vitae scelerisque suscipit. Nulla at metus ac urna aliquet egestas nec eu ligula.\r\n\r\nVestibulum volutpat, dui et commodo porta, nisi quam rutrum velit, nec pharetra nisl tellus non massa. In dignissim quis mi eget facilisis. Quisque blandit nisi leo, at feugiat urna elementum eu. Suspendisse scelerisque vehicula nisl, at consectetur felis sodales vulputate. Nulla sodales magna quis orci mattis iaculis nec a magna. Duis eget faucibus nisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque et justo ac velit rhoncus pulvinar.\r\n\r\nCras pulvinar leo ac auctor commodo. Vivamus quis nunc est. Etiam dapibus, enim at efficitur congue, turpis mi semper risus, sed interdum ligula lectus vel ipsum. Fusce sollicitudin elementum erat. Etiam sit amet arcu dui. Nullam ut erat egestas, fermentum erat a, aliquam augue. Nunc augue nunc, laoreet fermentum purus et, imperdiet iaculis justo. Donec id velit et dolor egestas condimentum. Sed vel ex ac sapien pharetra egestas.', 'inprogress');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 19 sep. 2022 à 23:25
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pokepedia`
--

-- --------------------------------------------------------

--
-- Structure de la table `damages`
--

DROP TABLE IF EXISTS `damages`;
CREATE TABLE IF NOT EXISTS `damages` (
  `id_damage` int(1) NOT NULL AUTO_INCREMENT,
  `name_damage` varchar(8) NOT NULL,
  `en_name_damage` varchar(8) NOT NULL,
  `icon_damage` varchar(128) NOT NULL,
  PRIMARY KEY (`id_damage`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `damages`
--

INSERT INTO `damages` (`id_damage`, `name_damage`, `en_name_damage`, `icon_damage`) VALUES
(1, 'Physique', 'Physical', 'images/damages/icon_physical.png'),
(2, 'Spéciale', 'Special', 'images/damages/icon_special.png'),
(3, 'Statut', 'Status', 'images/damages/icon_status.png');

-- --------------------------------------------------------

--
-- Structure de la table `evolution`
--

DROP TABLE IF EXISTS `evolution`;
CREATE TABLE IF NOT EXISTS `evolution` (
  `id_evolution` int(3) NOT NULL AUTO_INCREMENT,
  `evolution_from` int(3) NOT NULL,
  `evolution_to` int(3) NOT NULL,
  PRIMARY KEY (`id_evolution`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `evolution`
--

INSERT INTO `evolution` (`id_evolution`, `evolution_from`, `evolution_to`) VALUES
(1, 1, 2),
(2, 2, 3),
(3, 4, 5),
(4, 5, 6),
(5, 7, 8),
(6, 8, 9),
(7, 10, 11),
(8, 11, 12),
(9, 13, 14),
(10, 14, 15),
(11, 16, 17),
(12, 17, 18),
(13, 19, 20),
(14, 21, 22),
(15, 23, 24),
(16, 25, 26),
(17, 27, 28),
(18, 29, 30),
(19, 30, 31),
(20, 32, 33),
(21, 33, 34);

-- --------------------------------------------------------

--
-- Structure de la table `generations`
--

DROP TABLE IF EXISTS `generations`;
CREATE TABLE IF NOT EXISTS `generations` (
  `id_generation` int(1) NOT NULL AUTO_INCREMENT,
  `name_generation` varchar(16) NOT NULL,
  `short_name_generation` varchar(4) NOT NULL,
  `number_pokemon` int(3) NOT NULL,
  `first_pokemon` int(3) NOT NULL,
  `last_pokemon` int(3) NOT NULL,
  `name_region` varchar(8) NOT NULL,
  PRIMARY KEY (`id_generation`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `generations`
--

INSERT INTO `generations` (`id_generation`, `name_generation`, `short_name_generation`, `number_pokemon`, `first_pokemon`, `last_pokemon`, `name_region`) VALUES
(1, 'Première', '1ère', 151, 1, 151, 'Kanto'),
(2, 'Deuxième', '2ème', 100, 152, 251, 'Johto'),
(3, 'Troisième', '3ème', 135, 252, 386, 'Hoenn'),
(4, 'Quatrième', '4ème', 107, 387, 493, 'Sinnoh'),
(5, 'Cinquième', '5ème', 156, 494, 649, 'Unys'),
(6, 'Sixième', '6ème', 72, 650, 721, 'Kalos'),
(7, 'Septième', '7ème', 88, 722, 809, 'Alola'),
(8, 'Huitième', '8ème', 89, 810, 898, 'Galar');

-- --------------------------------------------------------

--
-- Structure de la table `pokedex`
--

DROP TABLE IF EXISTS `pokedex`;
CREATE TABLE IF NOT EXISTS `pokedex` (
  `id_pokemon` int(3) NOT NULL AUTO_INCREMENT,
  `fr_name_pokemon` varchar(16) CHARACTER SET utf8 NOT NULL,
  `en_name_pokemon` varchar(16) CHARACTER SET utf8 NOT NULL,
  `jp_name_pokemon` varchar(64) CHARACTER SET utf8 NOT NULL,
  `id_first_type` int(2) NOT NULL,
  `id_second_type` int(2) DEFAULT NULL,
  `category_pokemon` varchar(16) NOT NULL,
  `height_pokemon` float(4,1) NOT NULL,
  `weight_pokemon` float(4,1) NOT NULL,
  `first_talent` varchar(16) NOT NULL,
  `second_talent` varchar(16) DEFAULT NULL,
  `hidden_talent` varchar(16) DEFAULT NULL,
  `sex_pokemon` int(2) NOT NULL,
  `body_shape` int(2) NOT NULL,
  `group_pokemon` enum('Pokémon de Départ','Pokémon Légendaire','Pokémon Fabuleux','Bébé Pokémon') DEFAULT NULL,
  `image_pokemon` varchar(128) NOT NULL,
  `miniature_pokemon` varchar(128) NOT NULL,
  `shiny_pokemon` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id_pokemon`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pokedex`
--

INSERT INTO `pokedex` (`id_pokemon`, `fr_name_pokemon`, `en_name_pokemon`, `jp_name_pokemon`, `id_first_type`, `id_second_type`, `category_pokemon`, `height_pokemon`, `weight_pokemon`, `first_talent`, `second_talent`, `hidden_talent`, `sex_pokemon`, `body_shape`, `group_pokemon`, `image_pokemon`, `miniature_pokemon`, `shiny_pokemon`) VALUES
(1, 'Bulbizarre', 'Bulbasaur', 'フシギダネ Fushigidane', 2, 6, 'Graine', 0.7, 6.9, 'Engrais', NULL, 'Chlorophylle', 2, 8, 'Pokémon de Départ', 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/001.png', 'https://www.pokepedia.fr/images/4/4e/Miniature_001_LGPE.png', 'https://www.pokepedia.fr/images/b/bf/Sprite_001_chromatique_HOME.png'),
(2, 'Herbizarre', 'Ivysaur', 'フシギソウ (Fushigisō) Fushigisou', 2, 6, 'Graine', 1.0, 13.0, 'Engrais', NULL, 'Chlorophylle', 2, 8, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/002.png', 'https://www.pokepedia.fr/images/f/fb/Miniature_002_LGPE.png', NULL),
(3, 'Florizarre', 'Venusaur', 'フシギバナ Fushigibana', 2, 6, 'Graine', 2.0, 100.0, 'Engrais', NULL, 'Chlorophylle', 2, 8, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/003.png', 'https://www.pokepedia.fr/images/6/60/Miniature_003_LGPE.png', NULL),
(4, 'Salamèche', 'Charmander', 'ヒトカゲ Hitokage', 3, NULL, 'Lézard', 0.6, 8.5, 'Brasier', NULL, 'Force Soleil', 2, 6, 'Pokémon de Départ', 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/004.png', 'https://www.pokepedia.fr/images/8/89/Miniature_004_LGPE.png', NULL),
(5, 'Reptincel', 'Charmeleon', 'リザード (Rizādo) Lizardo', 3, NULL, 'Flamme', 1.1, 19.0, 'Brasier', NULL, 'Force Soleil', 2, 6, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/005.png', 'https://www.pokepedia.fr/images/3/35/Miniature_005_LGPE.png', NULL),
(6, 'Dracaufeu', 'Charizard', 'リザードン (Rizādon) Lizardon', 3, 7, 'Flamme', 1.7, 90.5, 'Brasier', NULL, 'Force Soleil', 2, 6, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/006.png', 'https://www.pokepedia.fr/images/6/68/Miniature_006_LGPE.png', NULL),
(7, 'Carapuce', 'Squirtle', 'ゼニガメ Zenigame', 4, NULL, 'Minitortue', 0.5, 9.0, 'Torrent', NULL, 'Cuvette', 2, 6, 'Pokémon de Départ', 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/007.png', 'https://www.pokepedia.fr/images/9/95/Miniature_007_LGPE.png', NULL),
(8, 'Carabaffe', 'Wartortle', 'カメール (Kamēru) Kameil', 4, NULL, 'Tortue', 1.0, 22.5, 'Torrent', NULL, 'Cuvette', 2, 6, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/008.png', 'https://www.pokepedia.fr/images/b/b6/Miniature_008_LGPE.png', NULL),
(9, 'Tortank', 'Blastoise', 'カメックス (Kamekkusu) Kamex', 4, NULL, 'Carapace', 1.6, 85.5, 'Torrent', NULL, 'Cuvette', 2, 6, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/009.png', 'https://www.pokepedia.fr/images/7/73/Miniature_009_LGPE.png', NULL),
(10, 'Chenipan', 'Caterpie', 'キャタピー (Kyatapī) Caterpie', 8, NULL, 'Ver', 0.3, 2.9, 'Écran Poudre', NULL, 'Fuite', 4, 14, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/010.png', 'https://www.pokepedia.fr/images/1/11/Miniature_010_LGPE.png', NULL),
(11, 'Chrysacier', 'Metapod', 'トランセル (Toranseru) Transel', 8, NULL, 'Cocon', 0.7, 9.9, 'Mue', NULL, NULL, 4, 2, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/011.png', 'https://www.pokepedia.fr/images/a/af/Miniature_011_LGPE.png', NULL),
(12, 'Papilusion', 'Butterfree', 'バタフリー (Batafurī) Butterfree', 8, 7, 'Papillon', 1.1, 32.0, 'Œil Composé', NULL, 'Lentiteintée', 4, 13, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/012.png', 'https://www.pokepedia.fr/images/5/5e/Miniature_012_EB.png', NULL),
(13, 'Aspicot', 'Weedle', 'ビードル (Bīdoru) Beedle', 8, 6, 'Insectopic', 0.3, 3.2, 'Écran Poudre', NULL, 'Fuite', 4, 14, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/013.png', 'https://www.pokepedia.fr/images/c/cb/Miniature_013_LGPE.png', NULL),
(14, 'Coconfort', 'Kakuna', 'コクーン (Kokūn) Cocoon', 8, 6, 'Cocon', 0.6, 10.0, 'Mue', NULL, NULL, 4, 2, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/014.png', 'https://www.pokepedia.fr/images/f/fd/Miniature_014_LGPE.png', NULL),
(15, 'Dardargnan', 'Beedrill', 'スピアー (Supiā) Spear', 8, 6, 'Guêpoison', 1.0, 29.5, 'Essaim', NULL, 'Sniper', 4, 13, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/015.png', 'https://www.pokepedia.fr/images/c/c9/Miniature_015_LGPE.png', NULL),
(16, 'Roucool', 'Pidgey', 'ポッポ Poppo', 1, 7, 'Minoiseau', 0.3, 1.8, 'Regard Vif', 'Pieds Confus', 'Cœur de Coq', 4, 9, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/016.png', 'https://www.pokepedia.fr/images/a/ad/Miniature_016_LGPE.png', NULL),
(17, 'Roucoups', 'Pidgeotto', 'ピジョン (Pijon) Pigeon', 1, 7, 'Oiseau', 1.1, 30.0, 'Regard Vif', 'Pieds Confus', 'Cœur de Coq', 4, 9, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/017.png', 'https://www.pokepedia.fr/images/5/54/Miniature_017_LGPE.png', NULL),
(18, 'Roucarnage', 'Pidgeot', 'ピジョット (Pijotto) Pigeot', 1, 7, 'Oiseau', 1.5, 39.5, 'Regard Vif', 'Pieds Confus', 'Cœur de Coq', 4, 9, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/018.png', 'https://www.pokepedia.fr/images/b/b6/Miniature_018_LGPE.png', NULL),
(19, 'Rattata', 'Rattata', 'コラッタ Koratta', 1, NULL, 'Souris', 0.3, 3.5, 'Fuite', 'Cran', 'Agitation', 4, 8, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/019.png', 'https://www.pokepedia.fr/images/7/7d/Miniature_019_LGPE.png', NULL),
(20, 'Rattatac', 'Raticate', 'ラッタ Ratta', 1, NULL, 'Souris', 0.7, 18.5, 'Fuite', 'Cran', 'Agitation', 4, 8, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/020.png', 'https://www.pokepedia.fr/images/9/93/Miniature_020_LGPE.png', NULL),
(21, 'Piafabec', 'Spearow', 'オニスズメ Onisuzume', 1, 7, 'Minoiseau', 0.3, 2.0, 'Regard Vif', NULL, 'Sniper', 4, 9, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/021.png', 'https://www.pokepedia.fr/images/b/b1/Miniature_021_LGPE.png', NULL),
(22, 'Rapasdepic', 'Fearow', 'オニドリル (Onidoriru) Onidrill', 1, 7, 'Bec-Oiseau', 1.2, 38.0, 'Regard Vif', NULL, 'Sniper', 4, 9, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/022.png', 'https://www.pokepedia.fr/images/8/89/Miniature_022_LGPE.png', NULL),
(23, 'Abo', 'Ekans', 'アーボ (Ābo) Arbo', 6, NULL, 'Serpent', 2.0, 6.9, 'Intimidation', 'Mue', 'Tension', 4, 2, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/023.png', 'https://www.pokepedia.fr/images/8/87/Miniature_023_LGPE.png', NULL),
(24, 'Arbok', 'Arbok', 'アーボック (Ābokku) Arbok', 6, NULL, 'Cobra', 3.5, 65.0, 'Intimidation', 'Mue', 'Tension', 4, 2, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/024.png', 'https://www.pokepedia.fr/images/9/97/Miniature_024_LGPE.png', NULL),
(25, 'Pikachu', 'Pikachu', 'ピカチュウ (Pikachū) Pikachu', 5, NULL, 'Souris', 0.4, 6.0, 'Statik', NULL, 'Paratonnerre', 4, 8, 'Pokémon de Départ', 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/025.png', 'https://www.pokepedia.fr/images/d/d6/Miniature_025_LGPE.png', NULL),
(26, 'Raichu', 'Raichu', 'ライチュウ (Raichū) Raichu', 5, NULL, 'Souris', 0.8, 30.0, 'Statik', NULL, 'Paratonnerre', 4, 6, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/026.png', 'https://www.pokepedia.fr/images/6/6f/Miniature_026_EB.png', NULL),
(27, 'Sabelette', 'Sandshrew', 'サンド (Sando) Sand', 9, NULL, 'Souris', 0.6, 12.0, 'Voile Sable', NULL, 'Baigne Sable', 4, 6, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/027.png', 'https://www.pokepedia.fr/images/8/8a/Miniature_027_LGPE.png', NULL),
(28, 'Sablaireau', 'Sandslash', 'サンドパン (Sandopan) Sandpan', 9, NULL, 'Souris', 1.0, 29.5, 'Voile Sable', NULL, 'Baigne Sable', 4, 6, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/028.png', 'https://www.pokepedia.fr/images/a/a7/Miniature_028_EB.png', NULL),
(29, 'Nidoran♀', 'Nidoran♀', 'ニドラン♀ Nidoran♀', 6, NULL, 'Vénépic', 0.4, 7.0, 'Point Poison', 'Rivalité', 'Agitation', 7, 8, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/029.png', 'https://www.pokepedia.fr/images/5/52/Miniature_029_LGPE.png', NULL),
(30, 'Nidorina', 'Nidorina', 'ニドリーナ (Nidorīna) Nidorina', 6, NULL, 'Vénépic', 0.8, 20.0, 'Point Poison', 'Rivalité', 'Agitation', 7, 8, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/030.png', 'https://www.pokepedia.fr/images/9/99/Miniature_030_LGPE.png', NULL),
(31, 'Nidoqueen', 'Nidoqueen', 'ニドクイン (Nidokuin) Nidoqueen', 6, 9, 'Perceur', 1.3, 60.0, 'Point Poison', 'Rivalité', 'Sans Limite', 7, 6, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/031.png', 'https://www.pokepedia.fr/images/e/e4/Miniature_031_EB.png', NULL),
(32, 'Nidoran♂', 'Nidoran♂', 'ニドラン♂ Nidoran♂', 6, NULL, 'Vénépic', 0.5, 9.0, 'Point Poison', 'Rivalité', 'Agitation', 1, 8, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/032.png', 'https://www.pokepedia.fr/images/f/f7/Miniature_032_LGPE.png', NULL),
(33, 'Nidorino', 'Nidorino', 'ニドリーノ (Nidorīno) Nidorino', 6, NULL, 'Vénépic', 0.9, 19.5, 'Point Poison', 'Rivalité', 'Agitation', 1, 8, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/033.png', 'https://www.pokepedia.fr/images/f/f3/Miniature_033_LGPE.png', NULL),
(34, 'Nidoking', 'Nidoking', 'ニドキング (Nidokingu) Nidoking', 6, 9, 'Perceur', 1.4, 62.0, 'Point Poison', 'Rivalité', 'Sans Limite', 1, 6, NULL, 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/034.png', 'https://www.pokepedia.fr/images/c/cf/Miniature_034_EB.png', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `sexes`
--

DROP TABLE IF EXISTS `sexes`;
CREATE TABLE IF NOT EXISTS `sexes` (
  `id_sex` int(2) NOT NULL AUTO_INCREMENT,
  `name_sex` varchar(64) NOT NULL,
  PRIMARY KEY (`id_sex`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sexes`
--

INSERT INTO `sexes` (`id_sex`, `name_sex`) VALUES
(1, 'Toujours mâles (100 % mâle)'),
(2, 'En grande majorité mâles (87,5 % mâle / 12,5 % femelle)'),
(3, 'En majorité mâles (75 % mâle / 25 % femelle)'),
(4, 'Égalitaires entre mâles et femelles (50 % mâle / 50 % femelle)'),
(5, 'En majorité femelles (75 % femelle / 25 % mâle)'),
(6, 'En grande majorité femelles (87,5 % femelle / 12,5 % mâle)'),
(7, 'Toujours femelles (100 % femelle)'),
(8, 'Asexués (pouvant se reproduire)'),
(9, 'Asexués (ne pouvant pas se reproduire)');

-- --------------------------------------------------------

--
-- Structure de la table `shape`
--

DROP TABLE IF EXISTS `shape`;
CREATE TABLE IF NOT EXISTS `shape` (
  `id_shape` int(2) NOT NULL AUTO_INCREMENT,
  `name_shape` varchar(64) NOT NULL,
  `image_shape` varchar(128) NOT NULL,
  PRIMARY KEY (`id_shape`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `shape`
--

INSERT INTO `shape` (`id_shape`, `name_shape`, `image_shape`) VALUES
(1, 'Pokémon constitués uniquement d\'une tête', 'https://www.pokepedia.fr/images/6/6b/Corps_1_HOME.png'),
(2, 'Pokémon avec un corps serpentin', 'https://www.pokepedia.fr/images/3/36/Corps_2_HOME.png'),
(3, 'Pokémon disposant de nageoires', 'https://www.pokepedia.fr/images/d/d1/Corps_3_HOME.png'),
(4, 'Pokémon constitués d\'une tête et de bras', 'https://www.pokepedia.fr/images/4/49/Corps_4_HOME.png'),
(5, 'Pokémon constitués d\'une tête et d\'un corps', 'https://www.pokepedia.fr/images/8/87/Corps_5_HOME.png'),
(6, 'Pokémon bipèdes disposant d\'une queue', 'https://www.pokepedia.fr/images/d/dd/Corps_6_HOME.png'),
(7, 'Pokémon constitués d\'une tête et de jambes', 'https://www.pokepedia.fr/images/4/46/Corps_7_HOME.png'),
(8, 'Pokémon quadrupèdes', 'https://www.pokepedia.fr/images/7/72/Corps_8_HOME.png'),
(9, 'Pokémon avec une seule paire d\'ailes', 'https://www.pokepedia.fr/images/3/34/Corps_9_HOME.png'),
(10, 'Pokémon avec des tentacules ou possédant de multiples pattes', 'https://www.pokepedia.fr/images/6/60/Corps_10_HOME.png'),
(11, 'Pokémon avec un corps multiple', 'https://www.pokepedia.fr/images/9/9c/Corps_11_HOME.png'),
(12, 'Pokémon bipèdes sans queue', 'https://www.pokepedia.fr/images/6/61/Corps_12_HOME.png'),
(13, 'Pokémon avec deux paires d\'ailes', 'https://www.pokepedia.fr/images/9/95/Corps_13_HOME.png'),
(14, 'Pokémon avec un corps insectoïde', 'https://www.pokepedia.fr/images/c/ce/Corps_14_HOME.png');

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id_status` int(1) NOT NULL AUTO_INCREMENT,
  `name_status` varchar(16) NOT NULL,
  `en_name_status` varchar(16) NOT NULL,
  `icon_status` varchar(128) NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `status`
--

INSERT INTO `status` (`id_status`, `name_status`, `en_name_status`, `icon_status`) VALUES
(1, 'Poison', 'Poisoned', 'images/status/icon_poisoned.png'),
(2, 'Poison +', 'Badly Poisoned', 'images/status/icon_badly_poisoned.png'),
(3, 'K.O.', 'Fainted', 'images/status/icon_fainted.png'),
(4, 'Gel', 'Frozen', 'images/status/icon_frozen.png'),
(5, 'Paralysie', 'Paralysis', 'images/status/icon_paralysis.png'),
(6, 'Sommeil', 'Asleep', 'images/status/icon_asleep.png'),
(7, 'Brûlure', 'Burned', 'images/status/icon_burned.png'),
(8, 'Pokérus', 'Pokerus', 'images/status/icon_pokérus.png');

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

DROP TABLE IF EXISTS `types`;
CREATE TABLE IF NOT EXISTS `types` (
  `id_type` int(2) NOT NULL AUTO_INCREMENT,
  `name_type` varchar(8) NOT NULL,
  `en_name_type` varchar(8) NOT NULL,
  `icon_type` varchar(128) NOT NULL,
  `logo_type` varchar(128) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `types`
--

INSERT INTO `types` (`id_type`, `name_type`, `en_name_type`, `icon_type`, `logo_type`) VALUES
(1, 'Normal', 'Normal', 'images/types/icon_normal.png', 'images/types/logo_normal.png'),
(2, 'Plante', 'Grass', 'images/types/icon_grass.png', 'images/types/logo_grass.png'),
(3, 'Feu', 'Fire', 'images/types/icon_fire.png', 'images/types/logo_fire.png'),
(4, 'Eau', 'Water', 'images/types/icon_water.png', 'images/types/logo_water.png'),
(5, 'Électrik', 'Electric', 'images/types/icon_electric.png', 'images/types/logo_electric.png'),
(6, 'Poison', 'Poison', 'images/types/icon_poison.png', 'images/types/logo_poison.png'),
(7, 'Vol', 'Flying', 'images/types/icon_flying.png', 'images/types/logo_flying.png'),
(8, 'Insecte', 'Bug', 'images/types/icon_bug.png', 'images/types/logo_bug.png'),
(9, 'Sol', 'Ground', 'images/types/icon_ground.png', 'images/types/logo_ground.png'),
(10, 'Combat', 'Fighting', 'images/types/icon_fighting.png', 'images/types/logo_fighting.png'),
(11, 'Psy', 'Psychic', 'images/types/icon_psychic.png', 'images/types/logo_psychic.png'),
(12, 'Roche', 'Rock', 'images/types/icon_rock.png', 'images/types/logo_rock.png'),
(13, 'Glace', 'Ice', 'images/types/icon_ice.png', 'images/types/logo_ice.png'),
(14, 'Spectre', 'Ghost', 'images/types/icon_ghost.png', 'images/types/logo_ghost.png'),
(15, 'Dragon', 'Dragon', 'images/types/icon_dragon.png', 'images/types/logo_dragon.png'),
(16, 'Acier', 'Steel', 'images/types/icon_steel.png', 'images/types/logo_steel.png'),
(17, 'Ténèbres', 'Dark', 'images/types/icon_dark.png', 'images/types/logo_dark.png'),
(18, 'Fée', 'Fairy', 'images/types/icon_fairy.png', 'images/types/logo_fairy.png'),
(19, 'Inconnu', 'Unknown', 'images/types/icon_unknown.png', 'images/types/logo_unknown.png'),
(20, 'Obscur', 'Shadow', 'images/types/icon_shadow.png', 'images/types/logo_shadow.png');

-- --------------------------------------------------------

--
-- Structure de la table `types_chart`
--

DROP TABLE IF EXISTS `types_chart`;
CREATE TABLE IF NOT EXISTS `types_chart` (
  `id_chart` int(3) NOT NULL AUTO_INCREMENT,
  `id_type_att` int(2) NOT NULL,
  `id_type_def` int(2) NOT NULL,
  `value_chart` float NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_chart`)
) ENGINE=MyISAM AUTO_INCREMENT=325 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `types_chart`
--

INSERT INTO `types_chart` (`id_chart`, `id_type_att`, `id_type_def`, `value_chart`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 1, 5, 1),
(6, 1, 6, 1),
(7, 1, 7, 1),
(8, 1, 8, 1),
(9, 1, 9, 1),
(10, 1, 10, 1),
(11, 1, 11, 1),
(12, 1, 12, 0.5),
(13, 1, 13, 1),
(14, 1, 14, 0),
(15, 1, 15, 1),
(16, 1, 16, 0.5),
(17, 1, 17, 1),
(18, 1, 18, 1),
(19, 2, 1, 1),
(20, 2, 2, 0.5),
(21, 2, 3, 0.5),
(22, 2, 4, 2),
(23, 2, 5, 1),
(24, 2, 6, 0.5),
(25, 2, 7, 0.5),
(26, 2, 8, 0.5),
(27, 2, 9, 2),
(28, 2, 10, 1),
(29, 2, 11, 1),
(30, 2, 12, 2),
(31, 2, 13, 1),
(32, 2, 14, 1),
(33, 2, 15, 0.5),
(34, 2, 16, 0.5),
(35, 2, 17, 1),
(36, 2, 18, 1),
(37, 3, 1, 1),
(38, 3, 2, 2),
(39, 3, 3, 0.5),
(40, 3, 4, 0.5),
(41, 3, 5, 1),
(42, 3, 6, 1),
(43, 3, 7, 1),
(44, 3, 8, 2),
(45, 3, 9, 1),
(46, 3, 10, 1),
(47, 3, 11, 1),
(48, 3, 12, 0.5),
(49, 3, 13, 2),
(50, 3, 14, 1),
(51, 3, 15, 0.5),
(52, 3, 16, 2),
(53, 3, 17, 1),
(54, 3, 18, 1),
(55, 4, 1, 1),
(56, 4, 2, 0.5),
(57, 4, 3, 2),
(58, 4, 4, 0.5),
(59, 4, 5, 1),
(60, 4, 6, 1),
(61, 4, 7, 1),
(62, 4, 8, 1),
(63, 4, 9, 2),
(64, 4, 10, 1),
(65, 4, 11, 1),
(66, 4, 12, 2),
(67, 4, 13, 1),
(68, 4, 14, 1),
(69, 4, 15, 0.5),
(70, 4, 16, 1),
(71, 4, 17, 1),
(72, 4, 18, 1),
(73, 5, 1, 1),
(74, 5, 2, 0.5),
(75, 5, 3, 1),
(76, 5, 4, 2),
(77, 5, 5, 0.5),
(78, 5, 6, 1),
(79, 5, 7, 2),
(80, 5, 8, 1),
(81, 5, 9, 0),
(82, 5, 10, 1),
(83, 5, 11, 1),
(84, 5, 12, 1),
(85, 5, 13, 1),
(86, 5, 14, 1),
(87, 5, 15, 0.5),
(88, 5, 16, 1),
(89, 5, 17, 1),
(90, 5, 18, 1),
(91, 6, 1, 1),
(92, 6, 2, 2),
(93, 6, 3, 1),
(94, 6, 4, 1),
(95, 6, 5, 1),
(96, 6, 6, 0.5),
(97, 6, 7, 1),
(98, 6, 8, 1),
(99, 6, 9, 0.5),
(100, 6, 10, 1),
(101, 6, 11, 1),
(102, 6, 12, 0.5),
(103, 6, 13, 1),
(104, 6, 14, 0.5),
(105, 6, 15, 1),
(106, 6, 16, 0),
(107, 6, 17, 1),
(108, 6, 18, 2),
(109, 7, 1, 1),
(110, 7, 2, 2),
(111, 7, 3, 1),
(112, 7, 4, 1),
(113, 7, 5, 0.5),
(114, 7, 6, 1),
(115, 7, 7, 1),
(116, 7, 8, 2),
(117, 7, 9, 1),
(118, 7, 10, 2),
(119, 7, 11, 1),
(120, 7, 12, 0.5),
(121, 7, 13, 1),
(122, 7, 14, 1),
(123, 7, 15, 1),
(124, 7, 16, 0.5),
(125, 7, 17, 1),
(126, 7, 18, 1),
(127, 8, 1, 1),
(128, 8, 2, 2),
(129, 8, 3, 0.5),
(130, 8, 4, 1),
(131, 8, 5, 1),
(132, 8, 6, 0.5),
(133, 8, 7, 0.5),
(134, 8, 8, 1),
(135, 8, 9, 1),
(136, 8, 10, 0.5),
(137, 8, 11, 2),
(138, 8, 12, 1),
(139, 8, 13, 1),
(140, 8, 14, 0.5),
(141, 8, 15, 1),
(142, 8, 16, 0.5),
(143, 8, 17, 2),
(144, 8, 18, 0.5),
(145, 9, 1, 1),
(146, 9, 2, 0.5),
(147, 9, 3, 2),
(148, 9, 4, 1),
(149, 9, 5, 2),
(150, 9, 6, 2),
(151, 9, 7, 0),
(152, 9, 8, 0.5),
(153, 9, 9, 1),
(154, 9, 10, 1),
(155, 9, 11, 1),
(156, 9, 12, 2),
(157, 9, 13, 1),
(158, 9, 14, 1),
(159, 9, 15, 1),
(160, 9, 16, 2),
(161, 9, 17, 1),
(162, 9, 18, 1),
(163, 10, 1, 2),
(164, 10, 2, 1),
(165, 10, 3, 1),
(166, 10, 4, 1),
(167, 10, 5, 1),
(168, 10, 6, 0.5),
(169, 10, 7, 0.5),
(170, 10, 8, 0.5),
(171, 10, 9, 1),
(172, 10, 10, 1),
(173, 10, 11, 0.5),
(174, 10, 12, 2),
(175, 10, 13, 2),
(176, 10, 14, 0),
(177, 10, 15, 1),
(178, 10, 16, 2),
(179, 10, 17, 2),
(180, 10, 18, 0.5),
(181, 11, 1, 1),
(182, 11, 2, 1),
(183, 11, 3, 1),
(184, 11, 4, 1),
(185, 11, 5, 1),
(186, 11, 6, 2),
(187, 11, 7, 1),
(188, 11, 8, 1),
(189, 11, 9, 1),
(190, 11, 10, 2),
(191, 11, 11, 0.5),
(192, 11, 12, 1),
(193, 11, 13, 1),
(194, 11, 14, 1),
(195, 11, 15, 1),
(196, 11, 16, 0.5),
(197, 11, 17, 0),
(198, 11, 18, 1),
(199, 12, 1, 1),
(200, 12, 2, 1),
(201, 12, 3, 2),
(202, 12, 4, 1),
(203, 12, 5, 1),
(204, 12, 6, 1),
(205, 12, 7, 2),
(206, 12, 8, 2),
(207, 12, 9, 0.5),
(208, 12, 10, 0.5),
(209, 12, 11, 1),
(210, 12, 12, 1),
(211, 12, 13, 2),
(212, 12, 14, 1),
(213, 12, 15, 1),
(214, 12, 16, 0.5),
(215, 12, 17, 1),
(216, 12, 18, 1),
(217, 13, 1, 1),
(218, 13, 2, 2),
(219, 13, 3, 0.5),
(220, 13, 4, 0.5),
(221, 13, 5, 1),
(222, 13, 6, 1),
(223, 13, 7, 2),
(224, 13, 8, 1),
(225, 13, 9, 2),
(226, 13, 10, 1),
(227, 13, 11, 1),
(228, 13, 12, 1),
(229, 13, 13, 0.5),
(230, 13, 14, 1),
(231, 13, 15, 2),
(232, 13, 16, 0.5),
(233, 13, 17, 1),
(234, 13, 18, 1),
(235, 14, 1, 0),
(236, 14, 2, 1),
(237, 14, 3, 1),
(238, 14, 4, 1),
(239, 14, 5, 1),
(240, 14, 6, 1),
(241, 14, 7, 1),
(242, 14, 8, 1),
(243, 14, 9, 1),
(244, 14, 10, 1),
(245, 14, 11, 2),
(246, 14, 12, 1),
(247, 14, 13, 1),
(248, 14, 14, 2),
(249, 14, 15, 1),
(250, 14, 16, 1),
(251, 14, 17, 0.5),
(252, 14, 18, 1),
(253, 15, 1, 1),
(254, 15, 2, 1),
(255, 15, 3, 1),
(256, 15, 4, 1),
(257, 15, 5, 1),
(258, 15, 6, 1),
(259, 15, 7, 1),
(260, 15, 8, 1),
(261, 15, 9, 1),
(262, 15, 10, 1),
(263, 15, 11, 1),
(264, 15, 12, 1),
(265, 15, 13, 1),
(266, 15, 14, 1),
(267, 15, 15, 2),
(268, 15, 16, 0.5),
(269, 15, 17, 1),
(270, 15, 18, 0),
(271, 16, 1, 1),
(272, 16, 2, 1),
(273, 16, 3, 0.5),
(274, 16, 4, 0.5),
(275, 16, 5, 0.5),
(276, 16, 6, 1),
(277, 16, 7, 1),
(278, 16, 8, 1),
(279, 16, 9, 1),
(280, 16, 10, 1),
(281, 16, 11, 1),
(282, 16, 12, 2),
(283, 16, 13, 2),
(284, 16, 14, 1),
(285, 16, 15, 1),
(286, 16, 16, 0.5),
(287, 16, 17, 1),
(288, 16, 18, 2),
(289, 17, 1, 1),
(290, 17, 2, 1),
(291, 17, 3, 1),
(292, 17, 4, 1),
(293, 17, 5, 1),
(294, 17, 6, 1),
(295, 17, 7, 1),
(296, 17, 8, 1),
(297, 17, 9, 1),
(298, 17, 10, 0.5),
(299, 17, 11, 2),
(300, 17, 12, 1),
(301, 17, 13, 1),
(302, 17, 14, 2),
(303, 17, 15, 1),
(304, 17, 16, 1),
(305, 17, 17, 0.5),
(306, 17, 18, 0.5),
(307, 18, 1, 1),
(308, 18, 2, 1),
(309, 18, 3, 0.5),
(310, 18, 4, 1),
(311, 18, 5, 1),
(312, 18, 6, 0.5),
(313, 18, 7, 1),
(314, 18, 8, 1),
(315, 18, 9, 1),
(316, 18, 10, 2),
(317, 18, 11, 1),
(318, 18, 12, 1),
(319, 18, 13, 1),
(320, 18, 14, 1),
(321, 18, 15, 2),
(322, 18, 16, 0.5),
(323, 18, 17, 2),
(324, 18, 18, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

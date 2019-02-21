-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Ven 21 Décembre 2018 à 17:59
-- Version du serveur :  5.7.24-0ubuntu0.18.04.1
-- Version de PHP :  7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `recette`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `idrec` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `day` datetime DEFAULT NULL,
  `commentaire` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`idrec`, `id`, `username`, `day`, `commentaire`) VALUES
(1, 1, 'antoine', '2018-05-03 01:01:01', 'Merci pour cette recette ! Toute la famille adore !'),
(1, 2, 'camille', '2018-05-04 01:01:01', 'J\'ajoute un verre de jus d\'orange'),
(1, 3, 'jacques', '2018-05-07 01:01:01', 'Délicieux! J\'ai servi avec des pâtes. Par rapport à certains commentaires négatifs au niveau de la cuisson, il faut souligner qu\'il est bien spécifié qu\'elle doit être menée à feu très doux '),
(2, 4, 'camille', '2018-08-25 01:01:01', 'Excellente recette que j\'ai réalisée pour la première fois. La prochaine fois, j\'enlèverai un peu de tomates pour rajouter des quartiers d\'orange et du jus d\'orange.');

-- --------------------------------------------------------

--
-- Structure de la table `etapes`
--

CREATE TABLE `etapes` (
  `idrecette` int(11) DEFAULT NULL,
  `idordre` int(11) DEFAULT NULL,
  `nom` varchar(20000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etapes`
--

INSERT INTO `etapes` (`idrecette`, `idordre`, `nom`) VALUES
(1, 1, 'Préchauffez le four à 200 degrés. Épluchez ou lavez bien les pommes de terre et taillez-les en rondelles de ½ cm. Disposez-les sur la plaque recouverte de papier sulfurisé, arrosez avec l\'huile de tournesol, puis salez et poivrez. Enfournez les dans le four préchauffé pour 30 à 40 minutes ou jusqu\'à ce qu\'elles soient dorées.'),
(1, 2, 'Équeutez les haricots verts et coupez-les en deux morceaux de taille égale. Versez un fond d\'eau dans la casserole. Ajoutez-y une pincée de sel ainsi que les haricots. À couvert, portez à ébullition et laissez cuire à petit bouillon pendant 8 à 10 minutes. Égouttez et réservez sans couvercle. Si vous le souhaitez, ajoutez un petit morceau du beurre aux haricots. Salez et poivrez.'),
(1, 3, 'Pendant ce temps, disposez les tranches de lard l\'une à côté de l\'autre, de sorte qu\'elles se chevauchent tout juste sur la longueur. Disposez l\'églefin sur les tranches et enroulez-le avec le lard.'),
(1, 4, 'Faites chauffer le reste de beurre dans la poêle et faites-y cuire le poisson lardé 2 à 3 minutes de chaque côté à feu moyen-vif, ou jusqu\'à ce qu\'il soit cuit. Poivrez.'),
(1, 5, 'Pendant ce temps, râpez la noix de muscade à l\'aide de la râpe fine. Attention : une pincée suffit.'),
(1, 6, 'Servez l\'églefin lardé avec les rondelles de pommes de terre et les haricots verts. Saupoudrez les haricots de noix de muscade et accompagnez le tout de la sauce ravigote.'),
(2, 1, 'Préparez le bouillon. Coupez les échalotes en huit quartiers dans le sens de la longueur. Nettoyez les champignons blonds avec de l\'essuie-tout, puis coupez-les en tranches. Prélevez le zeste du citron à l\'aide de la râpe fine et pressez le jus. Ciselez le cerfeuil et hachez grossièrement l\'estragon.'),
(2, 2, 'Faites chauffer l\'huile d\'olive à feu moyen dans la grande poêle et faites dorer les échalotes 16 à 18 minutes pour qu\'elles ramollissent bien. Ajoutez les champignons blonds et faites-les sauter durant les 5 à 7 dernières minutes. Salez et poivrez.'),
(2, 3, 'Pendant ce temps, faites chauffer la casserole à feu moyen-vif et faites revenir le couscous perlé à sec 1 minute. Ajoutez le bouillon, baissez le feu sur doux et laissez mijoter à couvert 12 minutes jusqu\'à absorption totale. Égouttez, égrainez et réservez sans couvercle.'),
(2, 4, 'Pendant ce temps, dans le petit bol, mélangez la ricotta, le pecorino râpé ainsi que ¼ cc de zeste et ½ cs de jus de citron par personne. Salez et ajoutez une généreuse quantité de poivre noir.'),
(2, 5, 'Ajoutez le beurre, la moitié du cerfeuil, la moitié de la ricotta au citron et le couscous perlé à la poêle contenant les échalotes et les champignons, puis remuez bien.'),
(2, 6, 'Servez le couscous sur les assiettes et garnissez avec le reste de ricotta au citron. Parsemez du reste de cerfeuil, d\'estragon et du reste de zeste de citron à votre guise. Arrosez avec le reste de jus de citron si vous le souhaitez.');

-- --------------------------------------------------------

--
-- Structure de la table `information`
--

CREATE TABLE `information` (
  `idrecette` int(11) NOT NULL,
  `dureecui` varchar(5) DEFAULT NULL,
  `dureerepos` varchar(5) DEFAULT NULL,
  `dureeprep` varchar(5) DEFAULT NULL,
  `diff` int(11) DEFAULT NULL,
  `cout` int(11) DEFAULT NULL,
  `categorie` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `information`
--

INSERT INTO `information` (`idrecette`, `dureecui`, `dureerepos`, `dureeprep`, `diff`, `cout`, `categorie`) VALUES
(1, '00:25', '00:30', '00:40', 4, 3, 'Légère'),
(2, '00:30', '00:25', '00:30', 2, 3, 'Veggie');

-- --------------------------------------------------------

--
-- Structure de la table `ingredients`
--

CREATE TABLE `ingredients` (
  `idrecette` int(11) DEFAULT NULL,
  `nom` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ingredients`
--

INSERT INTO `ingredients` (`idrecette`, `nom`) VALUES
(1, '400-g-pomme de terre{1-kg-lardon{1-cuillere-noix de muscade{400-g-haricots verts{500-g-filet d\'églefin{80-g-sauce ravigote{2-cuillere-huile de tournesol{1-pince-poivre et sel{2-cuillere-beurre{'),
(2, '30-g-échalote{250-g-champignons aux châtaignes{3-cuillere-citron{8-g-cerfeuil et estragon frais{170-g-semoule{100-g-ricotta{50-g-pecorino{600-ml-bouillon de légumes{2-cuillere-huile d\'olive{1-cuillere-beurre{1-pince-poivre et sel');

-- --------------------------------------------------------

--
-- Structure de la table `person`
--

CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `person`
--

INSERT INTO `person` (`id`, `username`, `name`, `lastname`, `email`, `password`, `type`) VALUES
(1, 'admin', NULL, NULL, 'admin@imt.com', '1a1dc91c907325c69271ddf0c944bc72', 3),
(2, 'antoine', NULL, NULL, 'antoine@imt.com', '1a1dc91c907325c69271ddf0c944bc72', 0),
(3, 'camille', NULL, NULL, 'camille@imt.com', '1a1dc91c907325c69271ddf0c944bc72', 0),
(4, 'jacques', NULL, NULL, 'jacques@imt.com', '1a1dc91c907325c69271ddf0c944bc72', 0);

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

CREATE TABLE `recette` (
  `id` int(11) NOT NULL,
  `titre` varchar(50) DEFAULT NULL,
  `iduser` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `statut` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `recette`
--

INSERT INTO `recette` (`id`, `titre`, `iduser`, `date`, `photo`, `statut`) VALUES
(1, 'Églefin lardé', 1, '2018-04-30 00:00:00', '1.png', 1),
(2, 'Couscous perlé', 2, '2018-08-24 00:00:00', '2.png', 0);

-- --------------------------------------------------------

--
-- Structure de la table `utensilles`
--

CREATE TABLE `utensilles` (
  `idrecette` int(11) DEFAULT NULL,
  `nom` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utensilles`
--

INSERT INTO `utensilles` (`idrecette`, `nom`) VALUES
(1, 'Papier cuisson{Cutting Board{Four{Poêle à frire{Plaque de cuisson{Couteau à fruits{Poêle + couvercle{Râpe{'),
(2, 'Bol{Poêle à frire{Poêle + couvercle{Râpe{');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idrec` (`idrec`);

--
-- Index pour la table `information`
--
ALTER TABLE `information`
  ADD KEY `idrecette` (`idrecette`);

--
-- Index pour la table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `recette`
--
ALTER TABLE `recette`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iduser` (`iduser`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `recette`
--
ALTER TABLE `recette`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`idrec`) REFERENCES `recette` (`id`);

--
-- Contraintes pour la table `information`
--
ALTER TABLE `information`
  ADD CONSTRAINT `information_ibfk_1` FOREIGN KEY (`idrecette`) REFERENCES `recette` (`id`);

--
-- Contraintes pour la table `recette`
--
ALTER TABLE `recette`
  ADD CONSTRAINT `recette_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `person` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

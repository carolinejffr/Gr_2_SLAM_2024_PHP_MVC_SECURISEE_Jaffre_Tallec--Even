-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 21, 2023 at 06:17 PM
-- Server version: 10.6.12-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gsbV2`
--

-- --------------------------------------------------------

--
-- Table structure for table `Etat`
--

CREATE TABLE `Etat` (
  `id` varchar(2) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Etat`
--

INSERT INTO `Etat` (`id`, `libelle`) VALUES
('CL', 'Saisie clôturée'),
('CR', 'Fiche créée, saisie en cours'),
('RB', 'Remboursée'),
('VA', 'Validée et mise en paiement');

-- --------------------------------------------------------

--
-- Table structure for table `FicheFrais`
--

CREATE TABLE `FicheFrais` (
  `idFrais` int(11) NOT NULL,
  `idVisiteur` varchar(4) NOT NULL,
  `mois` varchar(10) NOT NULL,
  `nbJustificatifs` int(11) NOT NULL,
  `montantValide` decimal(10,2) NOT NULL,
  `dateModif` datetime NOT NULL,
  `idEtat` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `FraisForfait`
--

CREATE TABLE `FraisForfait` (
  `id` varchar(3) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `montant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `FraisForfait`
--

INSERT INTO `FraisForfait` (`id`, `libelle`, `montant`) VALUES
('ETP', 'Forfait Etape', 110),
('KM', 'Frais Kilométrique', 1),
('NUI', 'Nuitée Hôtel', 80),
('REP', 'Repas Restaurant', 25);

-- --------------------------------------------------------

--
-- Table structure for table `LigneFraisForfait`
--

CREATE TABLE `LigneFraisForfait` (
  `idVisiteur` varchar(4) NOT NULL,
  `idFrais` int(11) NOT NULL,
  `mois` varchar(10) NOT NULL,
  `idFraisForfait` varchar(3) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `LigneFraisHorsForfait`
--

CREATE TABLE `LigneFraisHorsForfait` (
  `id` int(11) NOT NULL,
  `idFrais` int(11) NOT NULL,
  `idVisiteur` varchar(4) NOT NULL,
  `mois` varchar(10) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `montant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Visiteur`
--

CREATE TABLE `Visiteur` (
  `id` varchar(4) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `cp` int(11) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `dateEmbauche` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Visiteur`
--

INSERT INTO `Visiteur` (`id`, `nom`, `prenom`, `login`, `mdp`, `adresse`, `cp`, `ville`, `dateEmbauche`) VALUES
('a131', 'Villechalane', 'Louis', 'lvillachane', 'jux7g', '8 rue des Charmes', 46000, 'Cahors', '2005-12-21 00:00:00'),
('a17', 'Andre', 'David', 'dandre', 'oppg5', '1 rue Petit', 46200, 'Lalbenque', '1998-11-23 00:00:00'),
('a55', 'Bedos', 'Christian', 'cbedos', 'gmhxd', '1 rue Peranud', 46250, 'Montcuq', '1995-01-12 00:00:00'),
('a93', 'Tusseau', 'Louis', 'ltusseau', 'ktp3s', '22 rue des Ternes', 46123, 'Gramat', '2000-05-01 00:00:00'),
('b13', 'Bentot', 'Pascal', 'pbentot', 'doyw1', '11 allée des Cerises', 46512, 'Bessines', '1992-07-09 00:00:00'),
('b16', 'Bioret', 'Luc', 'lbioret', 'hrjfs', '1 Avenue gambetta', 46000, 'Cahors', '1998-05-11 00:00:00'),
('b19', 'Bunisset', 'Francis', 'fbunisset', '4vbnd', '10 rue des Perles', 93100, 'Montreuil', '1987-10-21 00:00:00'),
('b25', 'Bunisset', 'Denise', 'dbunisset', 's1y1r', '23 rue Manin', 75019, 'paris', '2010-12-05 00:00:00'),
('b28', 'Cacheux', 'Bernard', 'bcacheux', 'uf7r3', '114 rue Blanche', 75017, 'Paris', '2009-11-12 00:00:00'),
('b34', 'Cadic', 'Eric', 'ecadic', '6u8dc', '123 avenue de la République', 75011, 'Paris', '2008-09-23 00:00:00'),
('b4', 'Charoze', 'Catherine', 'ccharoze', 'u817o', '100 rue Petit', 75019, 'Paris', '2005-11-12 00:00:00'),
('b50', 'Clepkens', 'Christophe', 'cclepkens', 'bw1us', '12 allée des Anges', 93230, 'Romainville', '2003-08-11 00:00:00'),
('b59', 'Cottin', 'Vincenne', 'vcottin', '2hoh9', '36 rue Des Roches', 93100, 'Monteuil', '2001-11-18 00:00:00'),
('c14', 'Daburon', 'François', 'fdaburon', '7oqpv', '13 rue de Chanzy', 94000, 'Créteil', '2002-02-11 00:00:00'),
('c3', 'De', 'Philippe', 'pde', 'gk9kx', '13 rue Barthes', 94000, 'Créteil', '2010-12-14 00:00:00'),
('c54', 'Debelle', 'Michel', 'mdebelle', 'od5rt', '181 avenue Barbusse', 93210, 'Rosny', '2006-11-23 00:00:00'),
('d13', 'Debelle', 'Jeanne', 'jdebelle', 'nvwqq', '134 allée des Joncs', 44000, 'Nantes', '2000-05-11 00:00:00'),
('d51', 'Debroise', 'Michel', 'mdebroise', 'sghkb', '2 Bld Jourdain', 44000, 'Nantes', '2001-04-17 00:00:00'),
('e22', 'Desmarquest', 'Nathalie', 'ndesmarquest', 'f1fob', '14 Place d Arc', 45000, 'Orléans', '2005-11-12 00:00:00'),
('e24', 'Desnost', 'Pierre', 'pdesnost', '4k2o5', '16 avenue des Cèdres', 23200, 'Guéret', '2001-02-05 00:00:00'),
('e39', 'Dudouit', 'Frédéric', 'fdudouit', '44im8', '18 rue de l église', 23120, 'GrandBourg', '2000-08-01 00:00:00'),
('e49', 'Duncombe', 'Claude', 'cduncombe', 'qf77j', '19 rue de la tour', 23100, 'La souteraine', '1987-10-10 00:00:00'),
('e5', 'Enault-Pascreau', 'Céline', 'cenault', 'y2qdu', '25 place de la gare', 23200, 'Gueret', '1995-09-01 00:00:00'),
('e52', 'Eynde', 'Valérie', 'veynde', 'i7sn3', '3 Grand Place', 13015, 'Marseille', '1999-11-01 00:00:00'),
('f21', 'Finck', 'Jacques', 'jfinck', 'mpb3t', '10 avenue du Prado', 13002, 'Marseille', '2001-11-10 00:00:00'),
('f39', 'Frémont', 'Fernande', 'ffremont', 'xs5tq', '4 route de la mer', 13012, 'Allauh', '1998-10-01 00:00:00'),
('f4', 'Gest', 'Alain', 'agest', 'dywvt', '30 avenue de la mer', 13025, 'Berre', '1985-11-01 00:00:00'),
('lgbt', 'Carole', 'Carole', 'ccarole', 'password', '123 rue sésame', 69420, 'Prison de Rennes', '0001-01-01 00:00:00'),
('rtl2', 'Bibou', 'Jean', 'jbibou', 'mdptrofor', 'jhabite à coté de la mer', 69699, 'Durcit', '1807-04-01 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Etat`
--
ALTER TABLE `Etat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `FicheFrais`
--
ALTER TABLE `FicheFrais`
  ADD PRIMARY KEY (`idFrais`,`idVisiteur`,`mois`),
  ADD UNIQUE KEY `idFrais_UNIQUE` (`idFrais`),
  ADD KEY `FK_FicheFrais_idEtat` (`idEtat`),
  ADD KEY `FK_FicheFrais_idVisiteur` (`idVisiteur`);

--
-- Indexes for table `FraisForfait`
--
ALTER TABLE `FraisForfait`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `LigneFraisForfait`
--
ALTER TABLE `LigneFraisForfait`
  ADD PRIMARY KEY (`idVisiteur`,`mois`,`idFrais`) USING BTREE,
  ADD KEY `FK_LigneFraisForfait_idVisiteur_mois` (`idFrais`,`idVisiteur`,`mois`),
  ADD KEY `FK_LigneFraisForfait_idFraisForfait` (`idFraisForfait`);

--
-- Indexes for table `LigneFraisHorsForfait`
--
ALTER TABLE `LigneFraisHorsForfait`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_LigneFraisHorsForfait_idVisiteur_mois` (`idFrais`,`idVisiteur`,`mois`);

--
-- Indexes for table `Visiteur`
--
ALTER TABLE `Visiteur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `FicheFrais`
--
ALTER TABLE `FicheFrais`
  MODIFY `idFrais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `LigneFraisHorsForfait`
--
ALTER TABLE `LigneFraisHorsForfait`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `FicheFrais`
--
ALTER TABLE `FicheFrais`
  ADD CONSTRAINT `FK_FicheFrais_idEtat` FOREIGN KEY (`idEtat`) REFERENCES `Etat` (`id`),
  ADD CONSTRAINT `FK_FicheFrais_idVisiteur` FOREIGN KEY (`idVisiteur`) REFERENCES `Visiteur` (`id`);

--
-- Constraints for table `LigneFraisForfait`
--
ALTER TABLE `LigneFraisForfait`
  ADD CONSTRAINT `FK_LigneFraisForfait_idFraisForfait` FOREIGN KEY (`idFraisForfait`) REFERENCES `FraisForfait` (`id`),
  ADD CONSTRAINT `FK_LigneFraisForfait_idVisiteur_mois` FOREIGN KEY (`idFrais`,`idVisiteur`,`mois`) REFERENCES `FicheFrais` (`idFrais`, `idVisiteur`, `mois`);

--
-- Constraints for table `LigneFraisHorsForfait`
--
ALTER TABLE `LigneFraisHorsForfait`
  ADD CONSTRAINT `FK_LigneFraisHorsForfait_idVisiteur_mois` FOREIGN KEY (`idFrais`,`idVisiteur`,`mois`) REFERENCES `FicheFrais` (`idFrais`, `idVisiteur`, `mois`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

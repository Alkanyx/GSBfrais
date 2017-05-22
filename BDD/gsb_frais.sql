-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 22 Mai 2017 à 16:25
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gsb_frais`
--

-- --------------------------------------------------------

--
-- Structure de la table `comptable`
--

CREATE TABLE `comptable` (
  `id` int(11) NOT NULL,
  `login` text NOT NULL,
  `mdp` text NOT NULL,
  `nom` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `comptable`
--

INSERT INTO `comptable` (`id`, `login`, `mdp`, `nom`) VALUES
(1, 'comptable', 'c6113002e20e24dd8abca95227af93f2', 'Sebastien'),
(2, 'benjamin', 'b41f9a50f01651c4d548dd3cf0436ee6', 'Franklin');

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `id` char(2) COLLATE utf8_bin NOT NULL,
  `libelle` varchar(30) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `etat`
--

INSERT INTO `etat` (`id`, `libelle`) VALUES
('CL', 'Saisie clôturée'),
('CR', 'Fiche créée, saisie en cours'),
('MP', 'Mise en paiement'),
('RB', 'Remboursée'),
('VA', 'Validée');

-- --------------------------------------------------------

--
-- Structure de la table `fichefrais`
--

CREATE TABLE `fichefrais` (
  `idVisiteur` char(4) COLLATE utf8_bin NOT NULL,
  `mois` char(6) COLLATE utf8_bin NOT NULL,
  `nbJustificatifs` int(11) DEFAULT NULL,
  `montantValide` decimal(10,2) DEFAULT NULL,
  `dateModif` date DEFAULT NULL,
  `idEtat` char(2) COLLATE utf8_bin DEFAULT 'CR'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `fichefrais`
--

INSERT INTO `fichefrais` (`idVisiteur`, `mois`, `nbJustificatifs`, `montantValide`, `dateModif`, `idEtat`) VALUES
('a131', '201611', 0, '0.00', '2016-11-01', 'CL'),
('a131', '201612', 0, '0.00', '2017-05-22', 'CL'),
('a131', '201705', 0, '0.00', '2017-05-22', 'CR'),
('b28', '201612', 0, '0.00', '2016-12-15', 'CL'),
('c14', '201612', 0, '0.00', '2016-12-15', 'CL'),
('c3', '201611', 0, '0.00', '2016-12-01', 'CR'),
('c3', '201612', 0, '0.00', '2017-01-01', 'CL'),
('e24', '201611', 0, '0.00', '2016-11-01', 'CR'),
('e52', '201611', 0, '0.00', '2016-11-01', 'CL');

-- --------------------------------------------------------

--
-- Structure de la table `fraisforfait`
--

CREATE TABLE `fraisforfait` (
  `id` char(3) COLLATE utf8_bin NOT NULL,
  `libelle` char(20) COLLATE utf8_bin DEFAULT NULL,
  `montant` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `fraisforfait`
--

INSERT INTO `fraisforfait` (`id`, `libelle`, `montant`) VALUES
('ETP', 'Forfait Etape', '110.00'),
('KM', 'Frais Kilométrique', '0.62'),
('NUI', 'Nuitée Hôtel', '80.00'),
('REP', 'Repas Restaurant', '25.00');

-- --------------------------------------------------------

--
-- Structure de la table `lignefraisforfait`
--

CREATE TABLE `lignefraisforfait` (
  `idVisiteur` char(4) COLLATE utf8_bin NOT NULL,
  `mois` char(6) COLLATE utf8_bin NOT NULL,
  `idFraisForfait` char(3) COLLATE utf8_bin NOT NULL,
  `quantite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `lignefraisforfait`
--

INSERT INTO `lignefraisforfait` (`idVisiteur`, `mois`, `idFraisForfait`, `quantite`) VALUES
('a131', '201611', 'ETP', 3),
('a131', '201611', 'KM', 68),
('a131', '201611', 'NUI', 1),
('a131', '201611', 'REP', 0),
('a131', '201612', 'ETP', 1),
('a131', '201612', 'KM', 0),
('a131', '201612', 'NUI', 5),
('a131', '201612', 'REP', 0),
('a131', '201705', 'ETP', 5),
('a131', '201705', 'KM', 5),
('a131', '201705', 'NUI', 5),
('a131', '201705', 'REP', 5),
('b28', '201612', 'ETP', 0),
('b28', '201612', 'KM', 30),
('b28', '201612', 'NUI', 1),
('b28', '201612', 'REP', 3),
('c14', '201612', 'ETP', 1),
('c14', '201612', 'KM', 57),
('c14', '201612', 'NUI', 0),
('c14', '201612', 'REP', 2),
('c3', '201611', 'ETP', 12),
('c3', '201611', 'KM', 5),
('c3', '201611', 'NUI', 2),
('c3', '201611', 'REP', 4),
('c3', '201612', 'ETP', 51),
('c3', '201612', 'KM', 4),
('c3', '201612', 'NUI', 6),
('c3', '201612', 'REP', 5),
('e24', '201611', 'ETP', 1),
('e24', '201611', 'KM', 35),
('e24', '201611', 'NUI', 1),
('e24', '201611', 'REP', 1),
('e52', '201611', 'ETP', 0),
('e52', '201611', 'KM', 90),
('e52', '201611', 'NUI', 1),
('e52', '201611', 'REP', 0);

-- --------------------------------------------------------

--
-- Structure de la table `lignefraishorsforfait`
--

CREATE TABLE `lignefraishorsforfait` (
  `id` int(11) NOT NULL,
  `idVisiteur` char(4) COLLATE utf8_bin NOT NULL,
  `mois` char(6) COLLATE utf8_bin NOT NULL,
  `libelle` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `date` date DEFAULT NULL,
  `montant` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `lignefraishorsforfait`
--

INSERT INTO `lignefraishorsforfait` (`id`, `idVisiteur`, `mois`, `libelle`, `date`, `montant`) VALUES
(1, 'c3', '201611', 'piscine', '2016-02-11', '52.00'),
(2, 'c3', '201611', 'trampoline', '2016-11-10', '20.00'),
(3, 'c3', '201611', 'limousine', '2016-11-20', '200.10'),
(4, 'c3', '201611', 'spectacle', '2016-05-11', '30.00'),
(5, 'a131', '201612', 'piscine', '2016-11-10', '200.10'),
(6, 'a131', '201612', 'truc', '2015-12-11', '1.00'),
(7, 'b28', '201612', 'Piscine', '2016-11-10', '15.00'),
(8, 'b28', '201612', 'Karting', '2016-05-15', '30.00'),
(9, 'c14', '201612', 'Champagne', '2016-11-20', '31.50'),
(10, 'a131', '201611', 'Souris', '2015-12-18', '52.00'),
(11, 'a131', '201611', 'Sac', '2016-08-20', '20.00'),
(12, 'a131', '201612', 'Sac', '2016-08-20', '20.00'),
(13, 'e24', '201611', 'Dentifrice', '2016-04-12', '5.00'),
(14, 'e24', '201611', 'Glace', '2016-07-15', '4.00'),
(15, 'e24', '201611', 'Chemise', '2016-10-05', '29.99'),
(16, 'e52', '201611', 'Imprimante', '2016-02-17', '149.99'),
(17, 'e52', '201611', 'Horloge', '2016-05-04', '25.50'),
(18, 'a131', '201705', 'grzegerzgz', '2017-05-22', '1400.00'),
(19, 'a131', '201705', 'threerhetr', '2017-05-10', '600.00'),
(20, 'a131', '201705', 'threerhetr', '2017-05-10', '600.00');

-- --------------------------------------------------------

--
-- Structure de la table `visiteur`
--

CREATE TABLE `visiteur` (
  `id` char(4) COLLATE utf8_bin NOT NULL,
  `nom` char(30) COLLATE utf8_bin DEFAULT NULL,
  `prenom` char(30) COLLATE utf8_bin DEFAULT NULL,
  `login` char(20) COLLATE utf8_bin DEFAULT NULL,
  `mdp` char(33) COLLATE utf8_bin DEFAULT NULL,
  `adresse` char(30) COLLATE utf8_bin DEFAULT NULL,
  `cp` char(5) COLLATE utf8_bin DEFAULT NULL,
  `ville` char(30) COLLATE utf8_bin DEFAULT NULL,
  `dateEmbauche` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `visiteur`
--

INSERT INTO `visiteur` (`id`, `nom`, `prenom`, `login`, `mdp`, `adresse`, `cp`, `ville`, `dateEmbauche`) VALUES
('a131', 'Villechalane', 'Louis', 'lvillachane', '92eb980737f1854076b2e34933286d8e', '8 rue des Charmes', '46000', 'Cahors', '2005-12-21'),
('a17', 'Andre', 'David', 'dandre', '37f2381c9a729782c38410b1ea5b8191', '1 rue Petit', '46200', 'Lalbenque', '1998-11-23'),
('a55', 'Bedos', 'Christian', 'cbedos', 'd41d8cd98f00b204e9800998ecf8427e', '1 rue Peranud', '46250', 'Montcuq', '1995-01-12'),
('a93', 'Tusseau', 'Louis', 'ltusseau', 'f85f3127fc55f0ad7433b6879bc05f4e', '22 rue des Ternes', '46123', 'Gramat', '2000-05-01'),
('b13', 'Bentot', 'Pascal', 'pbentot', 'd41d8cd98f00b204e9800998ecf8427e', '11 allée des Cerises', '46512', 'Bessines', '1992-07-09'),
('b16', 'Bioret', 'Luc', 'lbioret', '566ea5a9b3a6f186928cc20711f13fa8', '1 Avenue gambetta', '46000', 'Cahors', '1998-05-11'),
('b19', 'Bunisset', 'Francis', 'fbunisset', '969c2fe5ac918a86a664b2041d5bc295', '10 rue des Perles', '93100', 'Montreuil', '1987-10-21'),
('b25', 'Bunisset', 'Denise', 'dbunisset', 'd41d8cd98f00b204e9800998ecf8427e', '23 rue Manin', '75019', 'paris', '2010-12-05'),
('b28', 'Cacheux', 'Bernard', 'bcacheux', 'f6b78ee75c60c4becd5ed3daaca14127', '114 rue Blanche', '75017', 'Paris', '2009-11-12'),
('b34', 'Cadic', 'Eric', 'ecadic', '36b98727aece53010ddde58639294427', '123 avenue de la République', '75011', 'Paris', '2008-09-23'),
('b4', 'Charoze', 'Catherine', 'ccharoze', 'd41d8cd98f00b204e9800998ecf8427e', '100 rue Petit', '75019', 'Paris', '2005-11-12'),
('b50', 'Clepkens', 'Christophe', 'cclepkens', '9ac1d70eef6e5f225b1db64eabaa4374', '12 allée des Anges', '93230', 'Romainville', '2003-08-11'),
('b59', 'Cottin', 'Vincenne', 'vcottin', 'e509e3ed6ac643ac405aba9c40ebc591', '36 rue Des Roches', '93100', 'Monteuil', '2001-11-18'),
('c14', 'Daburon', 'François', 'fdaburon', '44fda4ffdcf80a5f0c07fd0c82dafa4b', '13 rue de Chanzy', '94000', 'Créteil', '2002-02-11'),
('c3', 'De', 'Philippe', 'pde', 'd5d01f0959b81d8e99e0ff5ecec858f7', '13 rue Barthes', '94000', 'Créteil', '2010-12-14'),
('c54', 'Debelle', 'Michel', 'mdebelle', '5583dc317a2427151176da897d02847c', '181 avenue Barbusse', '93210', 'Rosny', '2006-11-23'),
('d13', 'Debelle', 'Jeanne', 'jdebelle', 'b7d60232b71cf9cbbfffa53cac58c2b6', '134 allée des Joncs', '44000', 'Nantes', '2000-05-11'),
('d51', 'Debroise', 'Michel', 'mdebroise', 'd41d8cd98f00b204e9800998ecf8427e', '2 Bld Jourdain', '44000', 'Nantes', '2001-04-17'),
('e22', 'Desmarquest', 'Nathalie', 'ndesmarquest', 'd41d8cd98f00b204e9800998ecf8427e', '14 Place d Arc', '45000', 'Orléans', '2005-11-12'),
('e24', 'Desnost', 'Pierre', 'pdesnost', 'f22a9af3e65d9b3942f242cb559374ae', '16 avenue des Cèdres', '23200', 'Guéret', '2001-02-05'),
('e39', 'Dudouit', 'Frédéric', 'fdudouit', '09723e8247fbdda4d2dda2d15d160dfd', '18 rue de l église', '23120', 'GrandBourg', '2000-08-01'),
('e49', 'Duncombe', 'Claude', 'cduncombe', '4b66fd37213456e6d58e79993a446241', '19 rue de la tour', '23100', 'La souteraine', '1987-10-10'),
('e5', 'Enault-Pascreau', 'Céline', 'cenault', '8c2cfac2fc5e3b1100842b3573720cc8', '25 place de la gare', '23200', 'Gueret', '1995-09-01'),
('e52', 'Eynde', 'Valérie', 'veynde', 'ea33b05db1515b43c387050ef64e687b', '3 Grand Place', '13015', 'Marseille', '1999-11-01'),
('f21', 'Finck', 'Jacques', 'jfinck', 'ec5014f6a2f2631952b6c677409a29fe', '10 avenue du Prado', '13002', 'Marseille', '2001-11-10'),
('f39', 'Frémont', 'Fernande', 'ffremont', '8774099cc05fd213276773425739ed85', '4 route de la mer', '13012', 'Allauh', '1998-10-01'),
('f4', 'Gest', 'Alain', 'agest', '8167f1d92b7c2666aaf0d6f77cbc761d', '30 avenue de la mer', '13025', 'Berre', '1985-11-01');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `comptable`
--
ALTER TABLE `comptable`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fichefrais`
--
ALTER TABLE `fichefrais`
  ADD PRIMARY KEY (`idVisiteur`,`mois`),
  ADD KEY `idEtat` (`idEtat`);

--
-- Index pour la table `fraisforfait`
--
ALTER TABLE `fraisforfait`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lignefraisforfait`
--
ALTER TABLE `lignefraisforfait`
  ADD PRIMARY KEY (`idVisiteur`,`mois`,`idFraisForfait`),
  ADD KEY `idFraisForfait` (`idFraisForfait`);

--
-- Index pour la table `lignefraishorsforfait`
--
ALTER TABLE `lignefraishorsforfait`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idVisiteur` (`idVisiteur`,`mois`);

--
-- Index pour la table `visiteur`
--
ALTER TABLE `visiteur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `comptable`
--
ALTER TABLE `comptable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `lignefraishorsforfait`
--
ALTER TABLE `lignefraishorsforfait`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `fichefrais`
--
ALTER TABLE `fichefrais`
  ADD CONSTRAINT `fichefrais_ibfk_1` FOREIGN KEY (`idEtat`) REFERENCES `etat` (`id`),
  ADD CONSTRAINT `fichefrais_ibfk_2` FOREIGN KEY (`idVisiteur`) REFERENCES `visiteur` (`id`);

--
-- Contraintes pour la table `lignefraisforfait`
--
ALTER TABLE `lignefraisforfait`
  ADD CONSTRAINT `lignefraisforfait_ibfk_1` FOREIGN KEY (`idVisiteur`,`mois`) REFERENCES `fichefrais` (`idVisiteur`, `mois`),
  ADD CONSTRAINT `lignefraisforfait_ibfk_2` FOREIGN KEY (`idFraisForfait`) REFERENCES `fraisforfait` (`id`);

--
-- Contraintes pour la table `lignefraishorsforfait`
--
ALTER TABLE `lignefraishorsforfait`
  ADD CONSTRAINT `lignefraishorsforfait_ibfk_1` FOREIGN KEY (`idVisiteur`,`mois`) REFERENCES `fichefrais` (`idVisiteur`, `mois`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 15 mai 2024 à 09:08
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetfinal`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `id_administrateur` varchar(255) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `mdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id_administrateur`, `nom`, `prenom`, `mdp`) VALUES
('1320FTB0047', 'manel', 'zekri', 'manel1320'),
('1340FTB0047', 'rania', 'ramezi', 'manel1320');

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE `demande` (
  `idEtudiant` varchar(255) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `adresseMail` varchar(30) NOT NULL,
  `specialite` varchar(30) NOT NULL,
  `nomSociete` varchar(20) NOT NULL,
  `sujet` varchar(20) NOT NULL,
  `descriptionSujet` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `demande`
--

INSERT INTO `demande` (`idEtudiant`, `nom`, `prenom`, `adresseMail`, `specialite`, `nomSociete`, `sujet`, `descriptionSujet`) VALUES
('221FTB7458', 'Lina khermiri', 'emna', 'lina@gmaol.com', 'bi', 'esprit', 'data', '');

-- --------------------------------------------------------

--
-- Structure de la table `encadrant`
--

CREATE TABLE `encadrant` (
  `idEncad` varchar(30) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `mdp` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `encadrant`
--

INSERT INTO `encadrant` (`idEncad`, `nom`, `prenom`, `mdp`) VALUES
('1320FTB', 'saa', 'fga', 'safasafa'),
('1456THV*', 'emna', 'emnaemna', 'emnaemna'),
('221478TB14', 'mhd', 'mhdhedi', 'mohamedhedi123');

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `nom` varchar(20) NOT NULL,
  `domaine` varchar(20) NOT NULL,
  `nomRepresentant` varchar(20) NOT NULL,
  `adresseMail` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `etudiant` (
  `id_etudiant` varchar(255) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `adresse_mail` varchar(100) NOT NULL,
  `motDePasse` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `etudiant` (`id_etudiant`, `nom`, `prenom`, `adresse_mail`, `motDePasse`) VALUES
('147FTB', 'Safa', 'Ben Haddad', 'safa.ben-haddad@esprit.tn', 'safasafa'),
('221FTB0047', 'zaineb', 'hedi', 'zaienb@esprit.tn', 'a4eae8aa5717d667b34157f4c2676d4374f9084393f0c7d1783e541d37c614bd'),
('221FTB0048', 'Safa', 'Ben Haddad', 'safa.ben-haddad@esprit.tn', 'safasafa'),
('221FTB0049', 'Safa', 'Ben Haddad', 'safa.ben-haddad@esprit.tn', 'ahmedahmed'),
('221FTB7458', 'safa', 'safa', 'safa.benhaddad@esprit.tn', 'safasafa');

-- --------------------------------------------------------

--
-- Structure de la table `stage`
--

CREATE TABLE `stage` (
  `idEtud` varchar(50) NOT NULL,
  `NomEtud` varchar(20) NOT NULL,
  `PrenomEtud` varchar(20) NOT NULL,
  `adresseMail` varchar(20) NOT NULL,
  `specialite` varchar(20) NOT NULL,
  `nomSoc` varchar(255) NOT NULL,
  `sujet` varchar(20) NOT NULL,
  `descriptionSujet` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `stage` (`idEtud`, `NomEtud`, `PrenomEtud`, `adresseMail`, `specialite`, `nomSoc`, `sujet`, `descriptionSujet`) VALUES
('221FTB0048', 'Lina khermiri', 'emna', 'lina@gmaol.com', 'bi', 'esprit', 'data', ''),
('221FTB0049', 'emna', 'elsa', 'majd@esprit.tn', 'bis', 'digital', 'Loacyop,', '');



CREATE TABLE `sujet` (
  `id_sujet` int(11) NOT NULL,
  `titre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id_administrateur`);


ALTER TABLE `demande`
  ADD PRIMARY KEY (`idEtudiant`);


ALTER TABLE `encadrant`
  ADD PRIMARY KEY (`idEncad`);


ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id_etudiant`);


ALTER TABLE `stage`
  ADD PRIMARY KEY (`idEtud`);


ALTER TABLE `sujet`
  ADD PRIMARY KEY (`id_sujet`);


ALTER TABLE `demande`
  ADD CONSTRAINT `c1` FOREIGN KEY (`idEtudiant`) REFERENCES `etudiant` (`id_etudiant`);
COMMIT;


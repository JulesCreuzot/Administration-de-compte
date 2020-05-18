-- Dernière MAJ :  mar. 17 avr. 2020 à 12:08
-- Version du serveur :  5.7.28
-- Version de PHP :  7.3.12
-- Base de données :  `votrechat`
--

--
-- Création de la Base de Données VotreCHat si elle n'exite pas
--

CREATE DATABASE IF NOT EXISTS `votrechat` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `votrechat`;

--
-- Suppressions de la table comptes si elle existe
--

DROP TABLE IF EXISTS `comptes`;

--
-- Création de la table comptes
--

CREATE TABLE IF NOT EXISTS `comptes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `pswd` char (65) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `pseudo` varchar(15) DEFAULT NULL,
  `description` text,
  `libelleComptes` varchar(15) NOT NULL DEFAULT 'Visiteur',
   `typesstatus` varchar(7) NOT NULL DEFAULT 'Valide',
   `nbtentative` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `libelleComptes` (`libelleComptes`),
  KEY `typesstatus` (`typesstatus`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;


--
-- Création de la table typesComptes
--

DROP TABLE IF EXISTS `typescomptes`;
CREATE TABLE IF NOT EXISTS `typescomptes` (
  `libelleComptes` varchar(15) NOT NULL,
  PRIMARY KEY (`libelleComptes`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Création de la table status
--

DROP TABLE IF EXISTS `typesstatus`;
CREATE TABLE IF NOT EXISTS `typesstatus` (
  `status` varchar(7) NOT NULL,
  PRIMARY KEY (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Ajout des clés étrangéres
--

ALTER TABLE `comptes`
  ADD CONSTRAINT `comptes_ibfk_1` FOREIGN KEY (`libelleComptes`) REFERENCES `typescomptes` (`libelleComptes`),
  ADD CONSTRAINT `comptes_ibfk_2` FOREIGN KEY (`typesstatus`) REFERENCES `typesstatus` (`status`);
COMMIT;


--
-- Ajout des types de status dans la table typesstatus
--

INSERT INTO `typesstatus` (`status`) VALUES
('Valide'),
('Bloquer');

--
-- Ajout des types de comptes dans la table typesComptes
--

INSERT INTO `typescomptes` (`libelleComptes`) VALUES
('Administrateur'),
('Visiteur');

--
-- Ajout des comptes nous servant pour l'essaie dans la table comptes
--
INSERT INTO `comptes` (`id`, `email`, `pswd`, `nom`, `prenom`, `pseudo`, `description`, `libelleComptes`) VALUES
(1, 'jules.creuzot@saint-remi.net', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'Creuzot', 'Jules', 'Luzko', 'Je suis moi même', 'Administrateur'),
(2, 'corentin.posson@saint-remi.net', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', NULL, NULL, 'CorPos', NULL, 'Visiteur');

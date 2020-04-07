-- Dernière MAJ :  mar. 07 avr. 2020 à 17:17
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
  `pswd` varchar(255) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `pseudo` varchar(15) DEFAULT NULL,
  `description` text,
  `libelleComptes` varchar(15) NOT NULL DEFAULT 'Visiteur',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `libelleComptes` (`libelleComptes`)
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
-- Ajout de la clé étrangére des comptes
--

ALTER TABLE `comptes`
  ADD CONSTRAINT `comptes_ibfk_1` FOREIGN KEY (`libelleComptes`) REFERENCES `typescomptes` (`libelleComptes`);
COMMIT;

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
(1, 'jules.creuzot@saint-remi.net', '1234', NULL, NULL, 'Luzko', NULL, 'Administrateur'),
(2, 'corentin.posson@saint-remi.net', '1111', NULL, NULL, 'CorPos', NULL, 'Administrateur'),
(3, 'julescreuzotbobo@gmail.com', '1111', 'Jules', 'Creuzot', 'Luzuzu', 'Je suis moi même', 'Visiteur');

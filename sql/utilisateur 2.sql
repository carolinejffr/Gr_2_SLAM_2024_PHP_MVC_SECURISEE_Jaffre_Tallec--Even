USE gsbV2;

DROP USER 'administrateur'@'localhost';
DROP USER 'visiteur';
DROP USER 'comptable';DROP USER 'communication';DROP USER 'laborecherche';DROP USER 'direction';DROP USER 'commercial';
DROP USER 'informatique';DROP USER 'developpeur';DROP USER 'reseau';

CREATE USER 'administrateur'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON *.* TO 'administrateur'@'localhost' WITH GRANT optiON;

CREATE USER 'visiteur' IDENTIFIED BY 'password';
GRANT INSERT,UPDATE (`date`,`montant`,`libelle`) ON `LigneFraisHorsForfait` TO visiteur;
GRANT INSERT,UPDATE (`quantite`,`mois`) ON `LigneFraisForfait` TO visiteur;
GRANT SELECT ON gsbV2.* TO visiteur;

CREATE USER 'comptable' IDENTIFIED BY 'password';
CREATE USER 'communication' IDENTIFIED BY 'password';
CREATE USER 'laborecherche' IDENTIFIED BY 'password';
CREATE USER 'direction' IDENTIFIED BY 'password';
CREATE USER 'commercial' IDENTIFIED BY 'password';

GRANT SELECT ON `FicheFrais`TO comptable,communication,laborecherche,direction,commercial;
GRANT SELECT,INSERT,UPDATE,DELETE ON `FraisForfait`TO comptable,communication,laborecherche,direction,commercial;
GRANT SELECT,INSERT,UPDATE,DELETE ON `LigneFraisForfait`TO comptable,communication,laborecherche,direction,commercial;
GRANT SELECT,INSERT,UPDATE,DELETE ON `Etat`TO comptable,communication,laborecherche,direction,commercial;
GRANT SELECT,INSERT,UPDATE,DELETE ON `LigneFraisHorsForfait` TO comptable,communication,laborecherche,direction,commercial;

GRANT SELECT ON gsbV2.* TO comptable,communication,laborecherche,direction,commercial;

CREATE USER 'informatique' IDENTIFIED BY 'password';
CREATE USER 'developpeur' IDENTIFIED BY 'password';
CREATE USER 'reseau' IDENTIFIED BY 'password';
GRANT CREATE,DROP,ALTER,SELECT,INSERT,UPDATE,DELETE ON `FicheFrais`TO informatique,developpeur,reseau;
GRANT CREATE,DROP,ALTER,SELECT,INSERT,UPDATE,DELETE ON `FraisForfait`TO informatique,developpeur,reseau;
GRANT CREATE,DROP,ALTER,SELECT,INSERT,UPDATE,DELETE ON `LigneFraisForfait`TO informatique,developpeur,reseau;
GRANT CREATE,DROP,ALTER,SELECT,INSERT,UPDATE,DELETE ON `Visiteur`TO informatique,developpeur,reseau;
GRANT CREATE,DROP,ALTER,SELECT,INSERT,UPDATE,DELETE ON `Etat`TO informatique,developpeur,reseau;
GRANT CREATE,DROP,ALTER,SELECT,INSERT,UPDATE,DELETE ON `LigneFraisHorsForfait` TO informatique,developpeur,reseau;


SHOW GRANTs FOR visiteur;
SHOW GRANTs FOR comptable;
SHOW GRANTs FOR communication;
SHOW GRANTs FOR informatique;
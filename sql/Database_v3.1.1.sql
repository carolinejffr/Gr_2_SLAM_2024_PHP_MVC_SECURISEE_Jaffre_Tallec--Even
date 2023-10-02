drop database if exists gsbV2;
create database if not exists gsbV2;

use gsbV2;

create table if not exists `FraisForfait` (
	`id` varchar(3) not null,
    `libelle` varchar(255) not null,
    `montant` int not null,
    constraint `PK_FraisForfait` primary key (`id`)
)ENGINE=InnoDB, CHARSET=UTF8MB4;

create table if not exists `Etat` (
	`id` varchar(2) not null,
    `libelle` varchar(255) not null,
    constraint `PK_Etat` primary key (`id`)
)ENGINE=InnoDB, CHARSET=UTF8MB4;

create table if not exists `Visiteur` (
	`id` varchar(4) not null,
    `nom` varchar(255) not null,
    `prenom` varchar(255) not null,
    `login` varchar(255) not null,
    `mdp` varchar(255) not null,
    `adresse` varchar(255) not null,
    `cp` int not null,
    `ville` varchar(255) not null,
    `dateEmbauche` datetime not null,
    constraint `PK_Visiteur` primary key (`id`)
)ENGINE=InnoDB, CHARSET=UTF8MB4;

create table if not exists `FicheFrais` (
	`idFrais` INT NOT NULL AUTO_INCREMENT ,
	`idVisiteur` varchar(4) not null,
    `mois` varchar(10) not null,
    `nbJustificatifs` int not null,
    `montantValide` DECIMAL(10,2) not null,
    `dateModif` datetime not null,
    `idEtat` varchar(2) not null,
    constraint `PK_FicheFrais` primary key (`idFrais`,`idVisiteur`,`mois`),
    constraint `FK_FicheFrais_idEtat` foreign key (`idEtat`) references Etat(id),
    constraint `FK_FicheFrais_idVisiteur` foreign key (`idVisiteur`) references Visiteur(id)
)ENGINE=InnoDB, CHARSET=UTF8MB4;

create table if not exists `LigneFraisForfait` (
	`idVisiteur` varchar(4) not null,
	`idFrais` INT NOT NULL,
    `mois` varchar(10) not null,
    `idFraisForfait` varchar(3) not null,
    `quantite` int not null,
    constraint `PK_LigneFraisForfait` primary key (`idVisiteur`,`mois`,`idFraisForfait`),
    constraint `FK_LigneFraisForfait_idVisiteur_mois` foreign key (`idFrais`,`idVisiteur`,`mois`) references FicheFrais(`idFrais`,`idVisiteur`,`mois`),
    constraint `FK_LigneFraisForfait_idFraisForfait` foreign key (`idFraisForfait`) references FraisForfait(`id`)
)ENGINE=InnoDB, CHARSET=UTF8MB4;

create table if not exists `LigneFraisHorsForfait` (
	`id` int not null auto_increment,
    `idFrais` int not null,
    `idVisiteur` varchar(4) not null,
    `mois` varchar(10) not null,
    `libelle` varchar(255) not null,
    `date` datetime not null,
    `montant` int not null,
    constraint `PK_LigneFraisHorsForfait` primary key (`id`),
    constraint `FK_LigneFraisHorsForfait_idVisiteur_mois` foreign key (`idFrais`,`idVisiteur`,`mois`) references FicheFrais(`idFrais`,`idVisiteur`,`mois`)
)ENGINE=InnoDB, CHARSET=UTF8MB4;

ALTER TABLE `gsbv2`.`fichefrais` 
ADD UNIQUE INDEX `idFrais_UNIQUE` (`idFrais` ASC);

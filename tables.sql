CREATE TABLE ENCHERE (
  enchere_id SMALLINT UNSIGNED AUTO_INCREMENT,
  date_debut DATE NOT NULL,
  date_fin DATE NOT NULL,
  prix_plancher DECIMAL NOT NULL,
  offre_actuelle DECIMAL,
  quantite_mises SMALLINT,
  coup_de_coeur_lord boolean,
  gagnant SMALLINT UNSIGNED,
  timbre_id SMALLINT UNSIGNED,
  archive boolean,
  FOREIGN KEY (timbre_id) REFERENCES TIMBRE(timbre_id),
  FOREIGN KEY (gagnant) REFERENCES UTILISATEUR(utilisateur_id),
  PRIMARY KEY (enchere_id)
);

CREATE TABLE IMAGE (
  image_id SMALLINT UNSIGNED AUTO_INCREMENT,
  image_url VARCHAR(100),
  PRIMARY KEY (image_id)
);


CREATE TABLE TIMBRE (
  timbre_id SMALLINT UNSIGNED AUTO_INCREMENT,
  nom VARCHAR(50),
  date_creation DATE NOT NULL,
  couleur VARCHAR(50) NOT NULL,
  pays_origine VARCHAR(50) NOT NULL,
  tirage VARCHAR(50) NOT NULL,
  dimensions VARCHAR(50) NOT NULL,
  certifie VARCHAR(50) NOT NULL,
  utilisateur SMALLINT UNSIGNED,
  image_id SMALLINT UNSIGNED,
  etat VARCHAR(50),
  enchere_id SMALLINT UNSIGNED,
  FOREIGN KEY (image_id) REFERENCES IMAGE (image_id),
  FOREIGN KEY (utilisateur) REFERENCES UTILISATEUR (utilisateur_id),
  FOREIGN KEY (enchere_id) REFERENCES ENCHERE (enchere_id),
  PRIMARY KEY (timbre_id)
);

CREATE TABLE ETAT(
  etat_id SMALLINT UNSIGNED AUTO_INCREMENT,
  nom VARCHAR(50) NOT NULL,
  timbre_id SMALLINT UNSIGNED,
  FOREIGN KEy (timbre_id) REFERENCES TIMBRE (timbre_id),
  PRIMARY KEY (etat_id)
);


CREATE TABLE FAVORIS(
  utilisateur_id SMALLINT UNSIGNED,
  enchere_id SMALLINT UNSIGNED,
  PRIMARY KEY (utilisateur_id, enchere_id),
  FOREIGN KEY (utilisateur_id) REFERENCES UTILISATEUR (utilisateur_id),
  FOREIGN KEY (enchere_id) REFERENCES ENCHERE (enchere_id)
  );

CREATE TABLE MISE (
  utilisateur_id SMALLINT UNSIGNED,
  enchere_id SMALLINT UNSIGNED,
  montant DECIMAL NOT NULL,
  date_mise DATE NOT NULL ,
  PRIMARY KEY (utilisateur_id, enchere_id),
  FOREIGN KEY (utilisateur_id) REFERENCES UTILISATEUR (utilisateur_id),
  FOREIGN KEY (enchere_id) REFERENCES ENCHERE (enchere_id)
);




-- =========================================================== -- 

CREATE TABLE UTILISATEUR (
  utilisateur_id SMALLINT UNSIGNED AUTO_INCREMENT,
  utilisateur_nom VARCHAR (50) NOT NULL,
  utilisateur_prenom VARCHAR (50) NOT NULL,
  utilisateur_courriel VARCHAR (100) NOT NULL,
  utilisateur_mdp VARCHAR (255) NOT NULL,
  utilisateur_adresse VARCHAR (50) NOT NULL,
  role_id SMALLINT UNSIGNED,
  PRIMARY KEY (utilisateur_id),
  FOREIGN KEY (role_id) REFERENCES ROLE (role_id)
);

CREATE TABLE ROLE(
  role_id SMALLINT UNSIGNED NOT NULL,
  nom VARCHAR(50) NOT NULL,
  PRIMARY KEY (role_id)
);

INSERT INTO `UTILISATEUR` (`utilisateur_id`, `utilisateur_nom`, `utilisateur_prenom`, `utilisateur_courriel`, `utilisateur_mdp`, `utilisateur_adresse`, `role_id`) VALUES
(1, 'admintes', 'test', 'test@test.ca', 'fb86376cb7bfd6553d365f1e9da9886c18d2b3adc19016202d0e32457e145d2b43cefeb08b3a871bc336048e1d62db32d88f3ad21d7231dc48922836bdb41855', '123 rue allo montreal qc canada', 1),
(2, 'Cartier', 'Jean', 'jeancartier@mail.ca', 'fb86376cb7bfd6553d365f1e9da9886c18d2b3adc19016202d0e32457e145d2b43cefeb08b3a871bc336048e1d62db32d88f3ad21d7231dc48922836bdb41855', '111 jeantalon montreal qc can ', 2);
-- Exemple d'insertion des rôles "client" et "administrateur" dans la table ROLE
INSERT INTO ROLE (role_id, nom) VALUES ('client', 'client'), ('administrateur', 'administrateur');




-- ==================== -- 
-- utilisateur et mots de passe : 

-- test@test.ca
-- a1b2c3d4e5

-- ella@elle.ca
-- A1b2c3d4e5!
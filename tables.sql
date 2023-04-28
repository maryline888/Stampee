CREATE TABLE ENCHERE (
  enchere_id SMALLINT UNSIGNED AUTO_INCREMENT,
  date_debut DATE NOT NULL,
  date_fin DATE NOT NULL,
  prix_plancher DECIMAL(19,2) NOT NULL,
  coup_de_coeur_lord boolean,
  archive boolean NOT NULL,
  utilisateur_id SMALLINT UNSIGNED,
  PRIMARY KEY (enchere_id),
  FOREIGN KEY (utilisateur_id) REFERENCES UTILISATEUR (utilisateur_id)
);

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

CREATE TABLE IMAGE (
  image_id SMALLINT UNSIGNED AUTO_INCREMENT,
  image_url VARCHAR(100),
  timbre_id SMALLINT UNSIGNED,
  FOREIGN KEY (timbre_id) REFERENCES TIMBRE (timbre_id),
  PRIMARY KEY (image_id)
);

CREATE TABLE TIMBRE (
  timbre_id SMALLINT UNSIGNED AUTO_INCREMENT,
  nom VARCHAR(50),
  date_creation DATE NOT NULL,
  couleur VARCHAR(20) NOT NULL,
  pays_origine VARCHAR(50) NOT NULL,
  tirage VARCHAR(50) ,
  dimensions VARCHAR(50) ,
  certifie boolean NOT NULL,
  etat VARCHAR(50),
  utilisateur SMALLINT UNSIGNED,
  enchere_id SMALLINT UNSIGNED,
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

-- date de mise desc 
CREATE TABLE MISE (
  mise_id SMALLINT UNSIGNED,
  utilisateur_id SMALLINT UNSIGNED,
  enchere_id SMALLINT UNSIGNED,
  montant DECIMAL(19,2) NOT NULL,
  date_mise DATE NOT NULL ,
  PRIMARY KEY (mise_id),
  FOREIGN KEY (utilisateur_id) REFERENCES UTILISATEUR (utilisateur_id),
  FOREIGN KEY (enchere_id) REFERENCES ENCHERE (enchere_id)
);

CREATE TABLE ROLE(
  role_id SMALLINT UNSIGNED NOT NULL,
  nom VARCHAR(50) NOT NULL,
  PRIMARY KEY (role_id)
);

INSERT INTO `UTILISATEUR` (`utilisateur_id`, `utilisateur_nom`, `utilisateur_prenom`, `utilisateur_courriel`, `utilisateur_mdp`, `utilisateur_adresse`, `role_id`) VALUES
(1, 'admintes', 'test', 'test@test.ca', 'fb86376cb7bfd6553d365f1e9da9886c18d2b3adc19016202d0e32457e145d2b43cefeb08b3a871bc336048e1d62db32d88f3ad21d7231dc48922836bdb41855', '123 rue allo montreal qc canada', 1),
(2, 'Cartier', 'Jean', 'jeancartier@mail.ca', 'fb86376cb7bfd6553d365f1e9da9886c18d2b3adc19016202d0e32457e145d2b43cefeb08b3a871bc336048e1d62db32d88f3ad21d7231dc48922836bdb41855', '111 jeantalon montreal qc can ', 2),

INSERT INTO ROLE VALUES ('2', 'client'), ('1', 'administrateur');



INSERT INTO `ROLE` (`role_id`, `nom`) VALUES
(1, 'administrateur'),
(2, 'client');


ALTER TABLE `MISE`
  ADD PRIMARY KEY (`mise_id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`),
  ADD KEY `enchere_id` (`enchere_id`);


ALTER TABLE `MISE`
  MODIFY `mise_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `MISE`
  ADD CONSTRAINT `mise_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `UTILISATEUR` (`utilisateur_id`),
  ADD CONSTRAINT `mise_ibfk_2` FOREIGN KEY (`enchere_id`) REFERENCES `ENCHERE` (`enchere_id`);
COMMIT;

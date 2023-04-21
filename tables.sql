CREATE TABLE ENCHERE (
  enchere_id SMALLINT UNSIGNED AUTO_INCREMENT,
  date_debut DATE NOT NULL,
  date_fin DATE NOT NULL,
  prix_plancher DECIMAL NOT NULL,
  coup_de_coeur_lord boolean,
  timbre_id SMALLINT UNSIGNED,
  archive boolean,
  FOREIGN KEY (timbre_id) REFERENCES TIMBRE(timbre_id),
  PRIMARY KEY (enchere_id)
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
  couleur VARCHAR(50) NOT NULL,
  pays_origine VARCHAR(50) NOT NULL,
  tirage VARCHAR(50) NOT NULL,
  dimensions VARCHAR(50) NOT NULL,
  certifie VARCHAR(50) NOT NULL,
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

CREATE TABLE MISE (
  utilisateur_id SMALLINT UNSIGNED,
  enchere_id SMALLINT UNSIGNED,
  montant DECIMAL NOT NULL,
  gagnant SMALLINT UNSIGNED,
  offre_actuelle DECIMAL,
  quantite_mises SMALLINT,
  date_mise DATE NOT NULL ,
  PRIMARY KEY (utilisateur_id, enchere_id),
  FOREIGN KEY (utilisateur_id) REFERENCES UTILISATEUR (utilisateur_id),
  FOREIGN KEY (enchere_id) REFERENCES ENCHERE (enchere_id)
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

CREATE TABLE ROLE(
  role_id SMALLINT UNSIGNED NOT NULL,
  nom VARCHAR(50) NOT NULL,
  PRIMARY KEY (role_id)
);

INSERT INTO `UTILISATEUR` (`utilisateur_id`, `utilisateur_nom`, `utilisateur_prenom`, `utilisateur_courriel`, `utilisateur_mdp`, `utilisateur_adresse`, `role_id`) VALUES
(1, 'admintes', 'test', 'test@test.ca', 'fb86376cb7bfd6553d365f1e9da9886c18d2b3adc19016202d0e32457e145d2b43cefeb08b3a871bc336048e1d62db32d88f3ad21d7231dc48922836bdb41855', '123 rue allo montreal qc canada', 1),
(2, 'Cartier', 'Jean', 'jeancartier@mail.ca', 'fb86376cb7bfd6553d365f1e9da9886c18d2b3adc19016202d0e32457e145d2b43cefeb08b3a871bc336048e1d62db32d88f3ad21d7231dc48922836bdb41855', '111 jeantalon montreal qc can ', 2),
(3, 'sss', 'ssss', 'sss@test.ca', '1f6f37c530c775842dc907ec3553edaf5d7d08c8327c78359312822e4e9adcebd0475cc92d02bd8d25952ba1c2f6da4b3ce5546618dec93059e2d6611118f466', 'sss sss ss', 1),
(4, 'sss', 'ssss', 'sss@test.ca', '1f6f37c530c775842dc907ec3553edaf5d7d08c8327c78359312822e4e9adcebd0475cc92d02bd8d25952ba1c2f6da4b3ce5546618dec93059e2d6611118f466', 'sss sss ss', 1),
(5, 'gagner', 'Ella', 'ella@elle.ca', '1f6f37c530c775842dc907ec3553edaf5d7d08c8327c78359312822e4e9adcebd0475cc92d02bd8d25952ba1c2f6da4b3ce5546618dec93059e2d6611118f466', 'mandeville', 2),
(6, 'mari', 'leblanc', 'mari@leblanc.ca', '1f6f37c530c775842dc907ec3553edaf5d7d08c8327c78359312822e4e9adcebd0475cc92d02bd8d25952ba1c2f6da4b3ce5546618dec93059e2d6611118f466', '123 djeje mejejd', 2),
(11, 'lasalla', 'lucien', 'lulu@hotmailc.com', '1f6f37c530c775842dc907ec3553edaf5d7d08c8327c78359312822e4e9adcebd0475cc92d02bd8d25952ba1c2f6da4b3ce5546618dec93059e2d6611118f466', 'asd neuw skdhug', 2),
(27, 'dddd', 'ddd', 'test121212@test.ca', '1f6f37c530c775842dc907ec3553edaf5d7d08c8327c78359312822e4e9adcebd0475cc92d02bd8d25952ba1c2f6da4b3ce5546618dec93059e2d6611118f466', 'dddd', 1),
(32, 'dddd', 'ddd', 'test121212@test.ca', '1f6f37c530c775842dc907ec3553edaf5d7d08c8327c78359312822e4e9adcebd0475cc92d02bd8d25952ba1c2f6da4b3ce5546618dec93059e2d6611118f466', 'dddd', 1),
(34, 'eeee', 'eee', 'eee@sss.ca', '1f6f37c530c775842dc907ec3553edaf5d7d08c8327c78359312822e4e9adcebd0475cc92d02bd8d25952ba1c2f6da4b3ce5546618dec93059e2d6611118f466', 'eee', 1),
(47, 'sss', 'sss', 'test@test.ca', '1f6f37c530c775842dc907ec3553edaf5d7d08c8327c78359312822e4e9adcebd0475cc92d02bd8d25952ba1c2f6da4b3ce5546618dec93059e2d6611118f466', 'sss', 2);

INSERT INTO ROLE VALUES ('2', 'client'), ('1', 'administrateur');

INSERT INTO `ETAT` (`etat_id`, `nom`, `timbre_id`) VALUES
(1, 'parfaite', NULL),
(2, 'excellente', NULL),
(3, 'bonne', NULL),
(4, 'moyenne', NULL),
(5, 'endommagé', NULL);



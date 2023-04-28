<?php

/**
 * Classe des requêtes SQL
 *
 */
class RequetesSQL extends RequetesPDO
{

  /* GESTION DES UTILISATEURS 
     ======================== */

  /**
   * Connecter un utilisateur
   * @param array $champs, tableau avec les champs utilisateur_courriel et utilisateur_mdp  
   * @return array|false ligne de la table, false sinon 
   */
  public function connecter($champs)
  {

    $this->sql = "
    SELECT *
    FROM utilisateur
    JOIN ROLE ON role.role_id = utilisateur.role_id 
    WHERE utilisateur_courriel = :utilisateur_courriel AND utilisateur_mdp = SHA2(:utilisateur_mdp, 512)";

    return $this->getLignes($champs, RequetesPDO::UNE_SEULE_LIGNE);
  }
  /**
   * Ajouter un utilisateur
   * @param array $champs tableau des champs de l'utilisateur 
   * @return string|boolean clé primaire de la ligne ajoutée, false sinon
   */
  public function ajouterUtilisateur($champs)
  {

    $this->sql = '
    INSERT INTO utilisateur 
    SET utilisateur_nom = :utilisateur_nom, 
    utilisateur_prenom = :utilisateur_prenom, 
    utilisateur_courriel = :utilisateur_courriel, 
    utilisateur_mdp = SHA2(:utilisateur_mdp, 512),
    utilisateur_adresse = :utilisateur_adresse,
    role_id = :role_id';

    return $this->CUDLigne($champs);
  }


  /**
   * Modifier un utilisateur
   * @param array $champs tableau avec les champs à modifier et la clé utilisateur_id
   * @return boolean true si modification effectuée, false sinon
   */
  public function modifierUtilisateur($champs)
  {
    $this->sql = '
      UPDATE utilisateur SET utilisateur_nom = :utilisateur_nom, utilisateur_prenom = :utilisateur_prenom, utilisateur_courriel = :utilisateur_courriel, utilisateur_adresse =  :utilisateur_adresse
      WHERE utilisateur_id = :utilisateur_id';
    return $this->CUDLigne($champs);
  }

  /**
   * Supprimer un utilisateur
   * @param int $utilisateur_id clé primaire
   * @return boolean true si suppression effectuée, false sinon
   */
  public function supprimerUtilisateur($utilisateur_id)
  {
    $this->sql = 'DELETE FROM utilisateur WHERE utilisateur_id = :utilisateur_id';
    return $this->CUDLigne(['utilisateur_id' => $utilisateur_id]);
  }

  public function getUtilisateurs()
  {
    $this->sql = 'SELECT *
    FROM utilisateur ORDER BY utilisateur_nom ASC';
    return $this->getLignes();
  }

  /**
   * @return array tableau des lignes produites par la select   
   */
  public function getUtilisateur($utilisateur_id)
  {
    $this->sql = "
      SELECT utilisateur_nom, utilisateur_prenom, utilisateur_courriel, utilisateur.role_id
      FROM utilisateur
      JOIN ROLE ON utilisateur.role_id = role.role_id
      WHERE utilisateur_id = :utilisateur_id";
    return $this->getLignes();
  }
  // =========================================

  /**
   * Ajoute une enchère dans la table ENCHERE
   *
   * @param array $champs Les valeurs des champs de l'enchère à ajouter
   * @return int Le dernier ID inséré
   */
  public function ajouterEnchere(array $champs)
  {

    $this->sql = '
            INSERT INTO ENCHERE 
            SET date_debut = :date_debut, 
            date_fin = :date_fin, 
            prix_plancher = :prix_plancher, 
            coup_de_coeur_lord = :coup_de_coeur_lord,
            archive = :archive,
            utilisateur_id = :utilisateur_id';

    return $this->CUDLigne($champs);
  }

  /**
   * Ajoute un timbre dans la table TIMBRE
   *
   * @param array $champs Les valeurs des champs du timbre à ajouter
   * @return int Le dernier ID inséré
   */
  public function ajouterTimbre(array $champs)
  {
    $this->sql = '
            INSERT INTO TIMBRE
            SET nom = :nom,
            date_creation = :date_creation,
            couleur = :couleur,
            pays_origine = :pays_origine,
            tirage = :tirage,
            dimensions = :dimensions,
            certifie = :certifie,
            enchere_id = :enchere_id,
            utilisateur = :utilisateur';
    return $this->CUDLigne($champs);
  }

  /**
   * Ajoute une image dans la table IMAGE
   *
   * @param array $champs Les valeurs des champs de l'image à ajouter
   * @return int Le dernier ID inséré
   */
  public function ajouterImage(array $champs)
  {

    $this->sql = '
        INSERT INTO IMAGE SET
        image_url = :image_url,
        timbre_id = :timbre_id';
    return $this->CUDLigne($champs);
  }


  /**
   * Afficher toutes les encheres  
   */

  // public function afficherEncheres()
  // {
  // }
  /**
   * afficher image dans le simili-carrousel encheres en cours
   */
  public function afficherImages()
  {

    $this->sql = 'SELECT image_url, timbre.timbre_id, nom, enchere.enchere_id, enchere.date_fin, enchere.prix_plancher 
    FROM TIMBRE 
    JOIN IMAGE ON timbre.timbre_id = image.timbre_id 
    JOIN ENCHERE ON timbre.enchere_id = enchere.enchere_id 
    ORDER BY enchere.enchere_id DESC
    ';
    return $this->getLignes();
  }
  /**
   * Afficher UNE enchere 
   */
  public function afficherUneEnchere($enchere_id)
  {
  }

  /**
   * miser
   */

  public function ajouterMise(array $champs)
  {
    $this->sql = 'INSERT INTO MISE SET utilisateur_id = :utilisateur_id, enchere_id = :enchere_id, montant = :montant, date_mise = :date_mise';
    return $this->CUDLigne($champs);
  }


  public function getPrix($enchere_id)
  {
    $this->sql = 'SELECT MAX(montant) as maximum FROM MISE WHERE enchere_id = :enchere_id';
    return $this->getLignes(['enchere_id' => $enchere_id], RequetesPDO::UNE_SEULE_LIGNE);
  }
}

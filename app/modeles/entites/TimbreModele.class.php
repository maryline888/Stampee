<?php

/**
 * Classe de l'entité timbre
 *
 */
class TimbreModele
{
  private $timbre_id;
  private $nom;
  private $date_creation;
  private $couleur;
  private $pays_origine;
  private $tirage;
  private $dimension;
  private $certifie;
  private $etat;
  // private $utilisateur;
  // private $enchere_id;


  private $erreurs = [];



  /**
   * Constructeur de la classe 
   * @param array $proprietes, tableau associatif des propriétés 
   */
  public function __construct($proprietes = [])
  {
    $t = array_keys($proprietes);
    foreach ($t as $nom_propriete) {
      $this->__set($nom_propriete, $proprietes[$nom_propriete]);
    }
  }

  /**
   * gette nécessaire  lutilisateur de twig
   * @param string $prop, nom de la propriété
   * @return property value
   */
  public function getTimbre_id()
  {
    return $this->timbre_id;
  }
  public function getNom()
  {
    return $this->nom;
  }
  public function getDate_creation()
  {
    return $this->date_creation;
  }
  public function getCouleur()
  {
    return $this->couleur;
  }
  public function getPays_origine()
  {
    return $this->pays_origine;
  }
  public function getTirage()
  {
    return $this->tirage;
  }
  public function getDimension()
  {
    return $this->dimension;
  }
  public function getCertifie()
  {
    return $this->certifie;
  }
  public function getEtat()
  {
    return $this->etat;
  }

  /**
   * Mutateur magique qui exécute le mutateur de la propriété en paramètre 
   * @param string $prop, nom de la propriété
   * @param $val, contenu de la propriété à mettre à jour
   */
  public function __set($prop, $val)
  {
    $setProperty = 'set' . ucfirst($prop);
    $this->$setProperty($val);
  }

  /**
   * Mutateur de la propriété timbre_id 
   * @param int $timbre_id
   * @return $this
   */
  public function settimbre_id($timbre_id)
  {
    unset($this->erreurs['timbre_id']);
    $regExp = '/^[1-9]\d*$/';
    if (!preg_match($regExp, $timbre_id)) {
      $this->erreurs['timbre_id'] = 'Numéro de timbre incorrect.';
    }
    $this->timbre_id = $timbre_id;
    return $this;
  }

  /**
   * Mutateur de la propriété timbre_titre 
   * @param string $timbre_titre
   * @return $this
   */
  public function setNom($nom)
  {
    unset($this->erreurs['nom']);
    $nom = trim($nom);
    $regExp = '/^.+$/';
    if (!preg_match($regExp, $nom)) {
      $this->erreurs['nom'] = 'Au moins un caractère.';
    }
    $this->nom = $nom;
    return $this;
  }

  /**
   * Mutateur de la propriété timbre_duree 
   * @param int $timbre_duree, en minutes
   * @return $this
   */
  public function setDate_creation($date_creation)
  {
    unset($this->erreurs['date_creation']);
    // if (!preg_match('/^[1-9]\d*$/', $timbre_duree) || $timbre_duree < self::DUREE_MIN || $timbre_duree > self::DUREE_MAX) {
    //   $this->erreurs['timbre_duree'] = "Entre " . self::DUREE_MIN . " et " . self::DUREE_MAX . ".";
    // }
    $this->date_creation = $date_creation;
    return $this;
  }

  /**
   * Mutateur de la propriété timbre_annee_sortie 
   * @param int $timbre_annee_sortie
   * @return $this
   */
  public function setCouleur($couleur)
  {
    unset($this->erreurs['couleur']);
    $nom = trim($couleur);
    $regExp = '/^.+$/';
    if (!preg_match($regExp, $couleur)) {
      $this->erreurs['couleur'] = 'Vous devez inscrire la couleur principale.';
    }
    $this->couleur = $couleur;
    return $this;
  }

  /**
   * Mutateur de la propriété timbre_resume
   * @param string $timbre_resume
   * @return $this
   */
  public function setPays_origine($pays_origine)
  {
    unset($this->erreurs['pays_origine']);
    $pays_origine = trim($pays_origine);
    $regExp = '/^[a-zA-Z\s]+$/';
    if (!preg_match($regExp, $pays_origine)) {
      $this->erreurs['pays_origine'] = 'Lettre et espace seulement';
    }
    $this->pays_origine = $pays_origine;
    return $this;
  }

  /**
   * Mutateur de la propriété timbre_affiche
   * @param string $timbre_affiche
   * @return $this
   */
  public function setTirage($tirage)
  {
    unset($this->erreurs['tirage']);
    $tirage = trim($tirage);
    $regExp = '/^\d+$/';
    if (!preg_match($regExp, $tirage)) {
      $this->erreurs['tirage'] = "chiffres seulement";
    }
    $this->tirage = $tirage;
    return $this;
  }

  /**
   * Mutateur de la propriété timbre_bande_annonce
   * @param string $timbre_bande_annonce
   * @return $this
   */
  public function setDimension($dimension)
  {
    unset($this->erreurs['dimension']);
    $dimension = trim($dimension);

    $this->timbre_bande_annonce = $dimension;
    return $this;
  }

  /**
   * Mutateur de la propriété timbre_statut
   * @param int $timbre_statut
   * @return $this
   */
  public function setCertifie($certifie)
  {
    unset($this->erreurs['certifie']);

    $this->erreurs['certifie'] = 'certifie incorrect.';
    $this->certifie = $certifie;
    return $this;
  }


  /**
   * Mutateur de la propriété timbre_genre_id 
   * @param int $timbre_genre_id
   * @return $this
   */
  public function setEtat($etat)
  {
    unset($this->erreurs['etat']);

    $this->etat = $etat;
    return $this;
  }
}

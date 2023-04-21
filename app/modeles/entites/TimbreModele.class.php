<?php

/**
 * Classe de l'entité timbre
 *
 */
class Timbre
{
  private $timbre_id;
  private $timbre_titre;
  private $timbre_duree;
  private $timbre_annee_sortie;
  private $timbre_resume;
  private $timbre_affiche;
  private $timbre_bande_annonce;
  private $timbre_statut;
  private $timbre_genre_id;


  private $erreurs = [];


  // const STATUT_INVISIBLE = 0;
  // const STATUT_VISIBLE   = 1;
  // const STATUT_ARCHIVE   = 2;

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
   * Accesseur magique d'une propriété de l'objet
   * @param string $prop, nom de la propriété
   * @return property value
   */
  public function __get($prop)
  {
    return $this->$prop;
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
  public function settimbre_titre($timbre_titre)
  {
    unset($this->erreurs['timbre_titre']);
    $timbre_titre = trim($timbre_titre);
    $regExp = '/^.+$/';
    if (!preg_match($regExp, $timbre_titre)) {
      $this->erreurs['timbre_titre'] = 'Au moins un caractère.';
    }
    $this->timbre_titre = mb_strtoupper($timbre_titre);
    return $this;
  }

  /**
   * Mutateur de la propriété timbre_duree 
   * @param int $timbre_duree, en minutes
   * @return $this
   */
  public function settimbre_duree($timbre_duree)
  {
    unset($this->erreurs['timbre_duree']);
    // if (!preg_match('/^[1-9]\d*$/', $timbre_duree) || $timbre_duree < self::DUREE_MIN || $timbre_duree > self::DUREE_MAX) {
    //   $this->erreurs['timbre_duree'] = "Entre " . self::DUREE_MIN . " et " . self::DUREE_MAX . ".";
    // }
    $this->timbre_duree = $timbre_duree;
    return $this;
  }

  /**
   * Mutateur de la propriété timbre_annee_sortie 
   * @param int $timbre_annee_sortie
   * @return $this
   */
  public function settimbre_annee_sortie($timbre_annee_sortie)
  {
    unset($this->erreurs['timbre_annee_sortie']);
    if (
      !preg_match('/^\d+$/', $timbre_annee_sortie) ||
      // $timbre_annee_sortie < self::ANNEE_PREMIER_timbre  ||
      $timbre_annee_sortie > date("Y")
    ) {
      // $this->erreurs['timbre_annee_sortie'] = "Entre " . self::ANNEE_PREMIER_timbre . " et l'année en cours.";
    }
    $this->timbre_annee_sortie = $timbre_annee_sortie;
    return $this;
  }

  /**
   * Mutateur de la propriété timbre_resume
   * @param string $timbre_resume
   * @return $this
   */
  public function settimbre_resume($timbre_resume)
  {
    unset($this->erreurs['timbre_resume']);
    $timbre_resume = trim($timbre_resume);
    $regExp = '/^\S+(\s+\S+){4,}$/';
    if (!preg_match($regExp, $timbre_resume)) {
      $this->erreurs['timbre_resume'] = 'Au moins 5 mots.';
    }
    $this->timbre_resume = $timbre_resume;
    return $this;
  }

  /**
   * Mutateur de la propriété timbre_affiche
   * @param string $timbre_affiche
   * @return $this
   */
  public function settimbre_affiche($timbre_affiche)
  {
    unset($this->erreurs['timbre_affiche']);
    $timbre_affiche = trim($timbre_affiche);
    $regExp = '/^.+\.jpg$/';
    if (!preg_match($regExp, $timbre_affiche)) {
      $this->erreurs['timbre_affiche'] = "Vous devez téléverser un fichier de type jpg.";
    }
    $this->timbre_affiche = $timbre_affiche;
    return $this;
  }

  /**
   * Mutateur de la propriété timbre_bande_annonce
   * @param string $timbre_bande_annonce
   * @return $this
   */
  public function settimbre_bande_annonce($timbre_bande_annonce)
  {
    unset($this->erreurs['timbre_bande_annonce']);
    $timbre_bande_annonce = trim($timbre_bande_annonce);
    $regExp = '/^.+\.mp4$/';
    if (!preg_match($regExp, $timbre_bande_annonce)) {
      $this->erreurs['timbre_bande_annonce'] = "Vous devez téléverser un fichier de type mp4.";
    }
    $this->timbre_bande_annonce = $timbre_bande_annonce;
    return $this;
  }

  /**
   * Mutateur de la propriété timbre_statut
   * @param int $timbre_statut
   * @return $this
   */
  //   public function settimbre_statut($timbre_statut)
  //   {
  //     unset($this->erreurs['timbre_statut']);
  //   //  if (
  //       // $timbre_statut != timbre::STATUT_INVISIBLE &&
  //       // $timbre_statut != timbre::STATUT_VISIBLE   &&
  //       // $timbre_statut != timbre::STATUT_ARCHIVE
  // //    ) {
  //       $this->erreurs['timbre_statut'] = 'Statut incorrect.';
  //     }
  //   //  $this->timbre_statut = $timbre_statut;
  //     return $this;
  //   }

  /**
   * Mutateur de la propriété timbre_genre_id 
   * @param int $timbre_genre_id
   * @return $this
   */
  public function settimbre_genre_id($timbre_genre_id)
  {
    unset($this->erreurs['timbre_genre_id']);
    $regExp = '/^[1-9]\d*$/';
    if (!preg_match($regExp, $timbre_genre_id)) {
      $this->erreurs['timbre_genre_id'] = 'Numéro de genre incorrect.';
    }
    $this->timbre_genre_id = $timbre_genre_id;
    return $this;
  }
}

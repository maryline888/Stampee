<?php

/**
 * Classe pour le modèle de l'entité timbre
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
  private $dimensions;
  private $certifie;
  private $etat;
  private $utilisateur;
  private $enchere_id;


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
   * getters nécessaire 
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
  public function getDimensions()
  {
    return $this->dimensions;
  }
  public function getCertifie()
  {
    return $this->certifie;
  }
  public function getEtat()
  {
    return $this->etat;
  }
  public function getErreurs()
  {
    return $this->erreurs;
  }
  public function getUtilisateur()
  {
    return $this->utilisateur;
  }
  public function getEchere_id()
  {
    return $this->enchere_id;
  }

  /**
   * Mutateur de la propriété timbre_id 
   * @param int $timbre_id
   * @return $this
   */
  public function setTimbre_id($timbre_id)
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
   * Mutateur de la propriété date_creation 
   * @param int $date_creation
   * @return $this
   */
  public function setDate_creation($date_creation)
  {
    unset($this->erreurs['date_creation']);
    $regExp = '/^(19|20)\d{2}$/';
    // Formater la date pour obtenir seulement l'année (4 chiffres)
    if (!preg_match($regExp, $date_creation)) {
      $this->erreurs['date_creation'] = 'svp inscrire une année à 4 chiffres commencant par 19 ou 20';
    }
    $this->date_creation = $date_creation . '01' . '01';

    return $this;
  }

  /**
   * Mutateur de la propriété couleur 
   * @param int $couleur
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
   * Mutateur de la propriété pays_origine
   * @param string $pays_origine
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
   * Mutateur de la propriété tirage
   * @param string $tirage
   * @return $this
   */
  public function setTirage($tirage)
  {
    unset($this->erreurs['tirage']);
    $tirage = trim($tirage);

    $this->tirage = $tirage;
    return $this;
  }

  /**
   * Mutateur de la propriété dimensions
   * @param string $dimensions
   * @return $this
   */
  public function setDimensions($dimensions)
  {
    unset($this->erreurs['dimensions']);
    $dimensions = trim($dimensions);

    $this->dimensions = $dimensions;
    return $this;
  }

  /**
   * @param $certifie
   * @return $this
   */
  public function setCertifie($certifie)
  {
    unset($this->erreurs['certifie']);
    if ($certifie == null || $certifie == false) {
      $certifie = 0;
    }
    $this->certifie = $certifie;
    return $this;
  }


  /**
   * @param int $etat
   * @return $this
   */
  public function setEtat($etat)
  {
    unset($this->erreurs['etat']);

    $this->etat = $etat;
    return $this;
  }

  /**
   * @param $utlisateur
   * @return $this
   */
  public function SetUtilisateur($utilisateur)
  {
    unset($this->erreurs['utilisateur']);

    $this->utilisateur = $utilisateur;
    return $this;
  }




  public function SetEnchere_id($enchere_id)
  {
    unset($this->erreurs['enchere_id']);

    $this->enchere_id = $enchere_id;
    return $this;
  }
}

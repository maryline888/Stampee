<?php

/**
 * Classe Contrôleur des requêtes de l'interface frontend
 * 
 */

class Utilisateur extends Routeur
{

  // private $timbre_id;
  private $oUtilConn;

  /**
   * Constructeur qui initialise des propriétés à partir du query string
   * et la propriété oRequetesSQL déclarée dans la classe Routeur
   * 
   */
  public function __construct()
  {
    $this->oUtilConn = $_SESSION['oUtilConn'] ?? null;
    $this->oRequetesSQL = new RequetesSQL;
  }

  public function inscription()
  {
  }

  public function gererUtilisateur()
  {
    if (isset($_SESSION['oUtilConn'])) {
      $this->oUtilConn = $_SESSION['oUtilConn'];

      if (isset($this->methodes[$this->entite])) {
        if (isset($this->methodes[$this->entite][$this->action])) {
          $methode = $this->methodes[$this->entite][$this->action];
          $this->$methode();
        } else {
          throw new Exception("$this->action de l'entité $this->entite n'existe pas.");
        }
      } else {
        throw new Exception("L'entité $this->entite n'existe pas.");
      }
    } else {
      $this->connexion();
    }
  }

  /**
   * Connecter un utilisateur
   */
  public function connexion()
  {
    $messageErreurConnexion = "";
    if (count($_POST) !== 0) {
      $utilisateur = $this->oRequetesSQL->connecter($_POST);
      if ($utilisateur !== false) {
        $_SESSION['oUtilConn'] = new Utilisateur($utilisateur);
        $this->oUtilConn = $_SESSION['oUtilConn'];
        $this->gererUtilisateur();
        exit;
      } else {
        $messageErreurConnexion = "Courriel ou mot de passe incorrect.";
      }
    }

    new Vue(
      'vConnexion',
      array(
        'titre'                  => 'Connexion',
        'actionUri'              => 'utilisateur',
        'messageErreurConnexion' => $messageErreurConnexion
      ),
      'gabarit-frontend'
    );
  }

  /**
   * Déconnecter un utilisateur
   */
  public function deconnexion()
  {
    unset($_SESSION['oUtilConn']);
    $this->connexion();
    new Vue(
      'vPageAcceuil',
      array(
        'actionUri'              => 'utilisateur',
      ),
      'gabarit-frontend'
    );
  }
}

<?php

/**
 * Classe Contrôleur des requêtes de l'application utilisateur
 */
// include_once('Routeur.class.php');

class Utilisateur extends Routeur
{

  private $utilisateur_id;
  private $oUtilConn;


  private $classRetour = "fait";
  private $retour = "";

  /**
   * Constructeur qui initialise des propriétés à partir du query string
   * et la propriété oRequetesSQL déclarée dans la classe Routeur
   * 
   */
  public function __construct()
  {
    $this->oUtilConn = $_SESSION['oUtilConn'] ?? null;
    $this->utilisateur_id  = $_GET['utilisateur_id'] ?? null;

    $this->oRequetesSQL = new RequetesSQL;
  }

  public function inscription()
  {
    $utilisateur  = [];
    $erreurs = [];
    if (count($_POST) !== 0) {
      $utilisateur = $_POST;

      $oUtilisateur = new UtilisateurModele($utilisateur); // création d'un objet Utilisateur pour contrôler la saisie
      $erreurs = $oUtilisateur->erreurs;
      if (count($erreurs) === 0) { // aucune erreur de saisie -> requête SQL d'ajout
        $utilisateur_id = $this->oRequetesSQL->ajouterUtilisateur([
          'utilisateur_nom'      => $oUtilisateur->utilisateur_nom,
          'utilisateur_prenom'   => $oUtilisateur->utilisateur_prenom,
          'utilisateur_courriel' => $oUtilisateur->utilisateur_courriel,
          'utilisateur_mdp'      => $oUtilisateur->utilisateur_mdp,
          'utilisateur_adresse'  => $oUtilisateur->utilisateur_adresse,
          'role_id'              => $oUtilisateur->role_id
        ]);

        $utilisateur_id = (int)$utilisateur_id;

        if ($utilisateur_id > 0) { // test de la clé de l'utilisateur ajouté
          // var_dump($utilisateur_id);
          $this->retour = "Ajout de l'utilisateur numéro $utilisateur_id effectué.";
        } else {
          $this->classRetour = "erreur";
          $this->retour = "Ajout de l'utilisateur non effectué.";
        }
        $_POST = array(
          'utilisateur_courriel' => $_POST['utilisateur_courriel'],
          'utilisateur_mdp' => $_POST['utilisateur_mdp']
        );
        $this->retour = "Ajout de l'utilisateur numéro $utilisateur_id effectué.";

        $this->connexion(); // retour sur la page de liste des utilisateurs
        exit;
      }
    }

    new Vue(
      'vInscription',
      array(
        'titre'                  => 'Inscription',
        'actionUri'              => 'inscription',
        'erreurs'                => $erreurs
      ),
      'gabarit-frontend'
    );
  }

  /**
   * Connecter un utilisateur
   * 
   * 
   */
  public function connexion()
  {


    $messageErreurConnexion = "";
    if (count($_POST) != 0) {

      $utilisateur = $this->oRequetesSQL->connecter($_POST);
      if ($utilisateur !== false) {
        $utilisateur = $this->oRequetesSQL->connecter($_POST);

        $_SESSION['oUtilConn'] = new UtilisateurModele($utilisateur);

        $this->oUtilConn = $_SESSION['oUtilConn'];
        var_dump($_SESSION['oUtilConn']);

        $this->getProfil();
        exit;
      } else {
        $messageErreurConnexion = "Courriel ou mot de passe incorrect.";
      }
    }
    new Vue(
      'vConnexion',
      array(
        'titre'                  => 'Connexion',
        'oUtilConn'              => $this->oUtilConn,
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
        'actionUri'              => 'deconnexion',
      ),
      'gabarit-frontend'
    );
  }

  public function getProfil()
  {
    if (count($_POST) !== 0) {
      //$utilisateur = $this->oRequetesSQL->getUtilisateur($this->utilisateur_id);
    }
    $this->oUtilConn = $_SESSION['oUtilConn'];

    new Vue(
      'vUtilisateur',
      array(
        'titre'                  => 'profil',
        'oUtilConn' => $this->oUtilConn,
      ),
      'gabarit-frontend'
    );
  }

  public function modifier()
  {

    $this->oUtilConn = $_SESSION['oUtilConn'];
    if (count($_POST) !== 0) {
      $utilisateur = $_POST;
      $oUtilisateur = new UtilisateurModele($utilisateur);
      $erreurs = $oUtilisateur->erreurs;
      if (count($erreurs) === 0) {
        if ($this->oRequetesSQL->modifierUtilisateur([

          'utilisateur_nom'    => $oUtilisateur->utilisateur_nom,
          'utilisateur_prenom' => $oUtilisateur->utilisateur_prenom,
          'utilisateur_courriel' => $oUtilisateur->utilisateur_courriel,
          'utilisateur_adresse' => $oUtilisateur->utilisateur_adresse,
        ])) {
          $this->retour = "Modification de l'utilisateur numéro $this->utilisateur_id effectuée.";
        } else {
          $this->classRetour = "erreur";
          $this->retour = "modification de l'utilisateur numéro $this->utilisateur_id non effectuée.";
        }
        $this->getProfil();
        exit;
      }
    } else {
      // chargement initial du formulaire  
      // initialisation des champs dans la vue formulaire avec les données SQL de cet utilisateur  
      // $utilisateur  = $this->oRequetesSQL->getUtilisateur($this->oUtilConn);
      // $erreurs = [];
    }

    new Vue(
      'vUtilisateurModif',
      array(
        'titre'     => 'modifier votre profil',
        'actionUri'              => 'deconnexion',

        'oUtilConn' => $this->oUtilConn,
      ),
      'gabarit-frontend'
    );
  }





  // public function gererUtilisateur()
  // {
  //   if (isset($_SESSION['oUtilConn'])) {
  //     $this->oUtilConn = $_SESSION['oUtilConn'];
  //     $entite = $this->methodes['UtilisateurModele'];

  //     if (isset($this->methodes[$this->entite])) {
  //       if (isset($this->methodes[$this->entite][$this->action])) {
  //         $methode = $this->methodes[$this->entite][$this->action];
  //         $this->$methode();
  //       } else {
  //         throw new Exception("$this->action de l'entité $this->entite n'existe pas.");
  //       }
  //     } else {
  //       throw new Exception("L'entité $this->entite n'existe pas.");
  //     }
  //   } else {
  //     $this->connexion();
  //   }
  // }

}

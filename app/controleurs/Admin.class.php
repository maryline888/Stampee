<?php

/**
 * Classe Contrôleur des requêtes de l'application admin
 */
include_once('Routeur.class.php');

class Admin extends Routeur
{
  private $entite;
  private $action;
  // private $film_id;
  private $utilisateur_id;

  private $oUtilConn;

  private $methodes = [
    'utilisateur' => [
      'l' => 'listerUtilisateurs',
      'd' =>  'deconnecter',
      'a' =>  'ajouterUtilisateur',
      'm' =>  'modifierUtilisateur',
      's' =>  'supprimerUtilisateur'
    ],
    'timbre' => [
      // 'l' =>  'listerFilms',
      // 'p' =>  'listerProchainement',
      // 'v' =>  'voirFilm',
    ],
  ];

  private $classRetour = "fait";
  private $messageRetour = "";

  /**
   * Constructeur qui initialise le contexte du contrôleur
   */
  public function __construct()
  {
    $this->entite   = $_GET['entite']   ?? 'utilisateur';
    $this->action   = $_GET['action']   ?? 'l';
    $this->utilisateur_id  = $_GET['utilisateur_id'] ?? null;
    $this->oRequetesSQL = new RequetesSQL;
  }

  /**
   * Gérer l'interface d'administration 
   */
  public function gererAdmin()
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
      $this->connecter();
    }
  }
  /**
   * Connecter un utilisateur
   */
  public function connecter()
  {
    $messageErreurConnexion = "";
    if (count($_POST) !== 0) {
      $utilisateur = $this->oRequetesSQL->connecter($_POST);
      if ($utilisateur !== false) {
        $_SESSION['oUtilConn'] = new Utilisateur($utilisateur);
        $this->oUtilConn = $_SESSION['oUtilConn'];
        $this->gererAdmin();
        exit;
      } else {
        $messageErreurConnexion = "Courriel ou mot de passe incorrect.";
      }
    }

    new Vue(
      'vConnexion',
      array(
        'titre'                  => 'Connexion',
        'actionUri'              => 'admin',
        'messageErreurConnexion' => $messageErreurConnexion
      ),
      'gabarit-admin-min'
    );
  }

  /**
   * Déconnecter un utilisateur
   */
  public function deconnecter()
  {
    unset($_SESSION['oUtilConn']);
    $this->connecter();
  }

  /**
   * Lister les utilisateurs
   */
  public function listerUtilisateurs()
  {
    $utilisateurs = $this->oRequetesSQL->getUtilisateurs();
    new Vue(
      'vAdminUtilisateurs',
      array(
        'oUtilConn'     => $this->oUtilConn,
        'titre'               => 'Gestion des utilisateurs',
        'utilisateurs'        => $utilisateurs,
        'classRetour'         => $this->classRetour,
        'messageRetour'       => $this->messageRetour
      ),
      'gabarit-admin'
    );
  }


  /**
   * Ajouter un utilisateur
   */
  public function ajouterUtilisateur()
  {

    $utilisateur  = [];
    $erreurs = [];
    if (count($_POST) !== 0) {
      // retour de saisie du formulaire
      $utilisateur = $_POST;
      $oUtilisateur = new Utilisateur($utilisateur); // création d'un objet Utilisateur pour contrôler la saisie
      $erreurs = $oUtilisateur->erreurs;
      if (count($erreurs) === 0) { // aucune erreur de saisie -> requête SQL d'ajout
        $utilisateur_id = $this->oRequetesSQL->ajouterUtilisateur([
          'utilisateur_nom'      => $oUtilisateur->utilisateur_nom,
          'utilisateur_prenom'   => $oUtilisateur->utilisateur_prenom,
          'utilisateur_courriel' => $oUtilisateur->utilisateur_courriel,
          'utilisateur_adresse'  => $oUtilisateur->utilisateur_adresse,
          'utilisateur_mdp'      => $oUtilisateur->utilisateur_mdp,
          'role_id'              => $oUtilisateur->role_id,
        ]);
        if ($utilisateur_id > 0) { // test de la clé de l'utilisateur ajouté
          $this->messageRetour = "Ajout de l'utilisateur numéro $utilisateur_id effectué.";
        } else {
          $this->classRetour = "erreur";
          $this->messageRetour = "Ajout de l'utilisateur non effectué.";
        }
        $this->listerUtilisateurs(); // retour sur la page de liste des utilisateurs
        exit;
      }
    }

    new Vue(
      'vAdminUtilisateurAjout',
      array(
        'oUtilConn'   =>    $this->oUtilConn,
        'titre'       =>    'Ajouter un utilisateur',
        'utilisateur' =>    $utilisateur,
        'erreurs'     =>    $erreurs
      ),
      'gabarit-admin'
    );
  }

  /**
   * Modifier un utilisateur identifié par sa clé dans la propriété utilisateur_id
   */
  public function modifierUtilisateur()
  {

    if (count($_POST) !== 0) {
      $utilisateur = $_POST;
      $oUtilisateur = new Utilisateur($utilisateur);
      $erreurs = $oUtilisateur->erreurs;
      if (count($erreurs) === 0) {
        if ($this->oRequetesSQL->modifierUtilisateur([
          'utilisateur_id'     => $oUtilisateur->utilisateur_id,
          'utilisateur_nom'    => $oUtilisateur->utilisateur_nom,
          'utilisateur_prenom' => $oUtilisateur->utilisateur_prenom,
          'utilisateur_adresse' => $oUtilisateur->utilisateur_adresse,
          'utilisateur_courriel' => $oUtilisateur->utilisateur_courriel
        ])) {
          $this->messageRetour = "Modification de l'utilisateur numéro $this->utilisateur_id effectuée.";
        } else {
          $this->classRetour = "erreur";
          $this->messageRetour = "modification de l'utilisateur numéro $this->utilisateur_id non effectuée.";
        }
        $this->listerUtilisateurs();
        exit;
      }
    } else {
      // chargement initial du formulaire  
      // initialisation des champs dans la vue formulaire avec les données SQL de cet utilisateur  
      $utilisateur  = $this->oRequetesSQL->getUtilisateur($this->utilisateur_id);
      $erreurs = [];
    }

    new Vue(
      'vAdminUtilisateurModif',
      array(
        'oUtilConn' =>    $this->oUtilConn,
        'titre'     =>    "Modifier l'utilisateur numéro $this->utilisateur_id",
        'utilisateur'  => $utilisateur,
        'erreurs'   =>     $erreurs
      ),
      'gabarit-admin'
    );
  }

  /**
   * Supprimer un utilisateur identifié par sa clé dans la propriété utilisateur_id
   */
  public function supprimerUtilisateur()
  {
    // if ($this->oUtilConn->utilisateur_profil) {
    //   throw new Exception(self::ERROR_FORBIDDEN);
    // }

    if ($this->oRequetesSQL->supprimerUtilisateur($this->utilisateur_id)) {
      $this->messageRetour = "Suppression de l'utilisateur numéro $this->utilisateur_id effectuée.";
    } else {
      $this->classRetour = "erreur";
      $this->messageRetour = "Suppression de l'utilisateur numéro $this->utilisateur_id non effectuée.";
    }
    $this->listerUtilisateurs();
  }
}//fin class
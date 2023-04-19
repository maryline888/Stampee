<?php

/**
 * Classe Contrôleur des requêtes de l'interface frontend
 * 
 */

class Frontend extends Routeur
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

  /**
   * Lister les films diffusés prochainement
   * 
   */
  public function pageAcceuil()
  {
    new Vue(
      "vPageAcceuil",
      array(
        'oUtilConn' => $this->oUtilConn,
        'titre'  => "Stampee",

      ),
      "gabarit-frontend"
    );
  }


  /**
   * Connecter un utilisateur
   */
  // public function connecter()
  // {
  //   $utilisateur = $this->oRequetesSQL->connecter($_POST);
  //   if ($utilisateur !== false) {
  //     $_SESSION['oUtilConn'] = new Utilisateur($utilisateur);
  //   }
  //   echo json_encode($utilisateur);
  // }

  /**
   * Déconnecter un utilisateur
   */
  // public function deconnecter()
  // {
  //   unset($_SESSION['oUtilConn']);
  //   echo json_encode(true);
  // }



  /**
   * Lister les ENCHÈRES 
   * 
   */
  // public function listerAlaffiche()
  // {
  //   $films = $this->oRequetesSQL->getFilms('enSalle');
  //   new Vue(
  //     "vListeFilms",
  //     array(
  //       'oUtilConn' => $this->oUtilConn,
  //       'titre'  => "À l'affiche",
  //       'films' => $films
  //     ),
  //     "gabarit-frontend"
  //   );
  // }

  /**
   * Lister les films diffusés prochainement
   * 
   */
  // public function listerProchainement()
  // {
  //   $films = $this->oRequetesSQL->getFilms('prochainement');
  //   new Vue(
  //     "vListeFilms",
  //     array(
  //       'oUtilConn' => $this->oUtilConn,
  //       'titre'  => "Prochainement",
  //       'films' => $films
  //     ),
  //     "gabarit-frontend"
  //   );
  // }

  /**
   * Voir les informations d'un film
   * 
   */
  // public function voirFilm()
  // {
  //   $film = false;
  //   if (!is_null($this->film_id)) {
  //     $film = $this->oRequetesSQL->getFilm($this->film_id);
  //     $realisateurs = $this->oRequetesSQL->getRealisateursFilm($this->film_id);
  //     $pays         = $this->oRequetesSQL->getPaysFilm($this->film_id);
  //     $acteurs      = $this->oRequetesSQL->getActeursFilm($this->film_id);
  //     $seancesTemp  = $this->oRequetesSQL->getSeancesFilm($this->film_id);

  //     $seances = [];

  //     foreach ($seancesTemp as $seance) {
  //       $seances[$seance['seance_date']]['jour']     = $seance['seance_jour'];
  //       $seances[$seance['seance_date']]['heures'][] = $seance['seance_heure'];
  //     }
  //   }
  //   if (!$film) throw new Exception("Film inexistant.");

  //   new Vue(
  //     "vFilm2",
  //     array(
  //       'oUtilConn' => $this->oUtilConn,
  //       'titre'        => $film['film_titre'],
  //       'film'         => $film,
  //       'realisateurs' => $realisateurs,
  //       'pays'         => $pays,
  //       'acteurs'      => $acteurs,
  //       'seances'      => $seances
  //     ),
  //     "gabarit-frontend"
  //   );
  // }
}

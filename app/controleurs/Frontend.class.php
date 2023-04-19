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
}

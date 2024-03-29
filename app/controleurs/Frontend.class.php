<?php

/**
 * Classe Contrôleur des requêtes de l'interface frontend
 * 
 */

class Frontend extends Routeur
{

  private $oUtilConn;
  private $oEnchere;
  private $oTimbre;
  private $oImage;
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
   * vue pour la page acceuil
   * 
   */
  public function pageAcceuil()
  {

    $encheres = $this->oRequetesSQL->afficherEncheres();
    new Vue(
      "vGabarits/gabarit-acceuil",
      array(
        'titre'  => "Stampee",
        'oUtilConn' => $this->oUtilConn,
        'encheres' => $encheres
      ),
      "vGabarits/gabarit-frontend"
    );
  }

  /**
   * vue pour la page catalogue 
   */
  public function pageCatalogue()
  {

    new Vue(
      "vGabarits/gabarit-catalogue",
      array(
        'oUtilConn' => $this->oUtilConn,
        'titre'  => "Catalogue d'enchères",
      ),
      "vGabarits/gabarit-frontend"
    );
  }
}

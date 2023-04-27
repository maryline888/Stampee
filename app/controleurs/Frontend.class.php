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
    // $this->oEnchere = new EnchereModele();
    // $this->oTimbre = new TimbreModele();
    // $this->oImage = new ImageModele($_FILES);
  }

  /**
   * vue pour la page acceuil
   * 
   */
  public function pageAcceuil()
  {

    if ($this->oUtilConn) {
      //$this->oRequetesSQL->afficherImages();
    }
    $encheres = $this->oRequetesSQL->afficherImages();
    // echo '<pre>';
    // print_r($encheres);
    new Vue(
      "vGabarits/gabarit-acceuil",
      array(
        'titre'  => "Stampee",
        'oUtilConn' => $this->oUtilConn,
        'encheres' => $encheres
        // 'oEnchere' => $this->oEnchere,
        // 'oTimbre' => $this->oTimbre,
        // 'oImage' => $this->oImage
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

  /**
   * fonction lister toutes les encheres qui sera utilisé pour afficher les encheres en cours 
   */
  // function listerEncheres()
  // {

  //   if ($this->oUtilConn) {
  //     //afficher que les encheres qui ne sont pas de lui....
  //   }

  //   $this->oRequetesSQL->afficherImages();
  //   new Vue(
  //     'vEncheres/vEnchereValidation',
  //     array(
  //       'oUtilConn' => $this->oUtilConn,
  //       'oEnchere' => $this->oEnchere,
  //       'oTimbre' => $this->oTimbre,
  //       'oImage' => $this->oImage

  //     ),
  //     'vGabarits/gabarit-frontend'
  //   );
  // }
}

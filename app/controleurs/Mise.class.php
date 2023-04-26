<?php

/**
 * Classe Contrôleur des requêtes de l'application mise
 */

class Mise extends Routeur
{
    private $oUtilConn;




    public function __construct()
    {
        $this->oUtilConn = $_SESSION['oUtilConn'] ?? null;

        $this->oRequetesSQL = new RequetesSQL;
    }

    public function ajouter()
    {
    }



    public function validation()
    {

        echo "validation mise";

        // new Vue(
        //     'vInscription',
        //     array(
        //       'titre'                  => 'Inscription',
        //       'erreurs'                => $erreurs
        //     ),
        //     'gabarit-frontend'
        //   );
    }
}//fin class
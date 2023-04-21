<?php

class Enchere extends Routeur
{


    private $oUtilConn;
    private $enchere_id;



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





    public function ajout()
    {



        if (!empty($_POST)) {
            // echo "traitement de formulaire ici";
            // die('ici');
            //  $this->oRequetesSQL->getAjouterEnchere;
        }


        new Vue(
            'vEnchereAjout',
            array(),
            'gabarit-frontend'
        );
    }
}//fin classe

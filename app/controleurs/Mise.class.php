<?php

/**
 * Classe Contrôleur des requêtes de l'application mise
 */

class Mise extends Routeur
{
    private $oUtilConn;
    private $oMise;
    // private $montant_max;
    // private $mise;
    private  $erreurs;
    private $messageErreur;

    public function __construct()
    {
        $this->oUtilConn = $_SESSION['oUtilConn'] ?? null;
        $this->oRequetesSQL = new RequetesSQL;
        $this->messageErreur;
        $this->oMise;
        $this->erreurs;
    }

    public function ajouter()
    {
        if (!empty($_POST) && $this->oUtilConn) {

            $enchere_id = (int)$_POST['enchere_id'];
            $montant = $_POST['montant'];
            $offre_actuelle =  $this->oRequetesSQL->getPrix($enchere_id);
            $offre_actuelle = (float)$offre_actuelle['maximum'];
            $montant = (float)$montant;

            // var_dump($offre_actuelle);
            // var_dump('offre', $offre_actuelle);

            // echo "<pre>";
            // print_r($mise);
            //var_dump($montant);
            if ($montant > $offre_actuelle) {
                $this->oMise = new MiseModele($_POST);
                // var_dump($_POST);
                //$this->oMise->montant = $mise;
                $this->oRequetesSQL->ajouterMise([
                    'utilisateur_id' => $this->oUtilConn->utilisateur_id,
                    'enchere_id'    =>  $this->oMise->enchere_id,
                    'montant'       =>  $this->oMise->montant,
                    'date_mise'     =>  $this->oMise->date_mise
                ]);
            } else {
                $this->messageErreur =  "Il semble y avoir une erreur sur le montant de la mise";
            }
        }
        new Vue(
            'vMises/miseValidation',
            array(
                'titre'                  => 'Stampee',
                'oUtilConn'              => $this->oUtilConn,
                'oMise'                  => $this->oMise,
                'erreurs'                => $this->erreurs,
                'messageRetour'          => $this->messageErreur
            ),
            'vGabarits/gabarit-frontend'
        );
    }
}//fin class
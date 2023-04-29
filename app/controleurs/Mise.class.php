<?php

/**
 * Classe Contrôleur des requêtes de l'application mise
 */

class Mise extends Routeur
{
    private $oUtilConn;
    private $oMise;
    private $montant;
    private $erreurs;
    private $messageErreur;

    public function __construct()
    {
        $this->oUtilConn = $_SESSION['oUtilConn'] ?? null;
        $this->oRequetesSQL = new RequetesSQL;
        $this->messageErreur;
        $this->oMise;
        $this->erreurs;
        $this->montant;
    }

    public function ajouter()
    {
        if (!empty($_POST) && $this->oUtilConn) {
            $enchere_id = (int)$_POST['enchere_id'];
            $utilisateurId = $this->oUtilConn->utilisateur_id;
            $montant = $_POST['montant'];
            $offre_actuelle =  $this->oRequetesSQL->getPrix($enchere_id);
            $offre_actuelle = (float)$offre_actuelle['maximum'];
            $montant = (float)$montant;

            if ($montant > $offre_actuelle) {
                $this->oMise = new MiseModele($_POST);
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
                'montant'                => $this->montant,
                'erreurs'                => $this->erreurs,
                'messageErreur'          => $this->messageErreur
            ),
            'vGabarits/gabarit-frontend'
        );
    }
}//fin class
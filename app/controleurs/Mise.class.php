<?php

/**
 * Classe Contrôleur des requêtes de l'application mise
 */

class Mise extends Routeur
{
    private $oUtilConn;
    // private $oMise;
    // private $montant_max;
    // private $mise;

    private $messageErreur;

    public function __construct()
    {
        $this->oUtilConn = $_SESSION['oUtilConn'] ?? null;
        $this->oRequetesSQL = new RequetesSQL;
        $this->messageErreur;
    }

    public function ajouter()
    {
        if (!empty($_POST) && $this->oUtilConn) {

            $enchere_id = (int)$_POST['enchere_id'];
            $mise = $_POST['montant'];
            $$mise = (float)$mise;
            $offre_actuelle =  $this->oRequetesSQL->getPrix($enchere_id);
            $offre_actuelle = (float)$offre_actuelle['maximum'];

            // var_dump($offre_actuelle);
            // var_dump('offre', $offre_actuelle);

            // echo "<pre>";
            // print_r($mise);
            // var_dump($mise);
            if ($mise > $offre_actuelle) {
                $oMise = new MiseModele($_POST);
                // var_dump($_POST);

                $this->oRequetesSQL->ajouterMise([
                    'utilisateur_id' => $this->oUtilConn->utilisateur_id,
                    'enchere_id'    => $oMise->enchere_id,
                    'montant'       => $oMise->montant,
                    'date_mise'     => $oMise->date_mise
                ]);
            } else {
                $this->erreurMise();
            }
        }
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
        //     'vGabarits/gabarit-frontend'
        //   );
    }



    public function erreurMise()
    {
        echo "erreur sur le montant";
    }
}//fin class
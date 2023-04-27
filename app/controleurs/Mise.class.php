<?php

/**
 * Classe Contrôleur des requêtes de l'application mise
 */

class Mise extends Routeur
{
    private $oUtilConn;
    private $utilisateur_id;



    public function __construct()
    {
        $this->oUtilConn = $_SESSION['oUtilConn'] ?? null;
        $this->utilisateur_id = $this->oUtilConn->utilisateur_id;
        $this->oRequetesSQL = new RequetesSQL;
    }

    public function ajouter()
    {
        if (!empty($_POST) && $this->utilisateur_id) {
            // var_dump($this->utilisateur_id);
            // echo "<pre>";
            // print_r($_POST);
            // die;
            $oMise = new MiseModele();


            // si qt mise == 0 alors valider le prix le prix plancher denchere else aller a mise actuelle
            // valider mise plus élevé que la mise_actuelle 
            // gerer la date de la mise = envoyer la date d'aujourdhui dans la bd   date()

            $nb_mise = $this->oRequetesSQL->getNombreMise();
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
}//fin class
<?php

class Enchere extends Routeur
{


    private $oUtilConn;
    private $enchere_id;
    private $utilisateur_id;



    /**
     * Constructeur qui initialise des propriétés à partir du query string
     * et la propriété oRequetesSQL déclarée dans la classe Routeur
     * 
     */
    public function __construct()
    {
        $this->oUtilConn = $_SESSION['oUtilConn'] ?? null;
        $this->utilisateur_id  = $_GET['utilisateur_id'] ?? null;
        $this->oRequetesSQL = new RequetesSQL;
    }

    public function ajout()
    {

        $enchere = [];
        $erreurs = [];
        $_POST_enchere = [];
        $_POST_timbre = [];
        $_POST_image = [];

        // si post is empty = il va montrer direct la vue vEnchereAjout

        if (!empty($_POST)) {
            $enchere = $_POST;

            $oEnchere = new EnchereModele($enchere);
            $erreurs = $oEnchere->erreurs;

            if (count($erreurs) === 0) {
                $enchere_id = $this->oRequetesSQL->ajouterEnchere([
                    'date_debut' => $oEnchere->date_debut,
                    'date_fin' => $oEnchere->date_fin,
                    'prix_plancher' => $oEnchere->prix_plancher,
                    'coup_de_coeur_lord' => $oEnchere->coup_de_coeur_lord,
                    'timbre_id' => $oEnchere->timbre_id,
                    'archive' => $oEnchere->archive
                ]);
                $enchere_id = (int)$enchere_id;

                // Séparer $_POST en 3 tableaux distincts
                $_POST_enchere = array_filter($_POST, function ($key) {
                    return substr($key, 0, 9) === 'enchere_';
                }, ARRAY_FILTER_USE_KEY);

                $_POST_timbre = array_filter($_POST, function ($key) {
                    return substr($key, 0, 7) === 'timbre_';
                }, ARRAY_FILTER_USE_KEY);

                $_POST_image = array_filter($_POST, function ($key) {
                    return substr($key, 0, 7) === 'image_';
                }, ARRAY_FILTER_USE_KEY);

                // Copier les valeurs de $_POST dans les nouveaux tableaux
                $_POST_enchere = array_intersect_key($_POST, $_POST_enchere);
                $_POST_timbre = array_intersect_key($_POST, $_POST_timbre);
                $_POST_image = array_intersect_key($_POST, $_POST_image);
            }
        }

        new Vue(
            'vEnchereAjout',
            array(),
            'gabarit-frontend'
        );
    }

    // public function ajout()
    // {

    //     $enchere = [];
    //     $erreurs = [];
    //     $_POST_enchere = [];
    //     $_POST_timbre = [];
    //     $_POST_image = [];

    //     // si post is empty = il va montrer direct la vue vEnchereAjout

    //     if (!empty($_POST)) {
    //         $enchere = $_POST;

    //         $oEnchere = new EnchereModele($enchere);
    //         $erreurs = $oEnchere->erreurs;

    //         if (count($erreurs) === 0) {



    //             $enchere_id = $this->oRequetesSQL->ajouterEnchere([


    //                 'date_debut' => $oEnchere->date_debut,
    //                 'date_fin' => $oEnchere->date_fin,
    //                 'prix_plancher' => $oEnchere->prix_plancher,
    //                 'coup_de_coeur_lord' => $oEnchere->coup_de_coeur_lord,
    //                 'timbre_id' => $oEnchere->timbre_id,
    //                 'archive' => $oEnchere->archive

    //             ]);
    //             $enchere_id = (int)$enchere_id;
    //             // '<pre>';
    //             // print_r($_POST);
    //             //creer objet enchere 
    //         }
    //         // il faut separer le $_POST en 3 array different 

    //         // $_POST_enchere =
    //         // $_POST_timbre =
    //         // $_POST_image =

    //         // echo "traitement de formulaire ici";
    //         // die('ici');


    //         //  $this->oRequetesSQL->getAjouterEnchere;
    //     }


    //     new Vue(
    //         'vEnchereAjout',
    //         array(),
    //         'gabarit-frontend'
    //     );
    // }
}//fin classe

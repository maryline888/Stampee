<?php

class Enchere extends Routeur
{


    private $oUtilConn;
    private $enchere_id;
    private $utilisateur_id;
    private $enchere_erreurs;
    private $timbre_erreurs;




    /**
     * Constructeur qui initialise des propriétés à partir du query string
     * et la propriété oRequetesSQL déclarée dans la classe Routeur
     * 
     */
    public function __construct()
    {
        $this->oUtilConn = $_SESSION['oUtilConn'] ?? null;

        $this->enchere_id  = $_POST['enchere_id'] ?? null;
        $this->oRequetesSQL = new RequetesSQL;
    }

    public function ajout()
    {
        // var_dump('LIGNE:31', $_POST);
        //$this->utilisateur_id  = $this->oUtilConn->utilisateur_id;
        $enchere_erreurs = [];
        $timbre_erreurs = [];

        $_POST_enchere = [];
        $_POST_timbre = [];


        // si post is empty = il va montrer direct la vue vEnchereAjout

        if (!empty($_POST)) {


            $_POST_enchere = [
                'date_debut'         => $_POST['date_debut'],
                'date_fin'           => $_POST['date_fin'],
                'prix_plancher'      => $_POST['prix_plancher'],
                'coup_de_coeur_lord' => $_POST['coup_de_coeur_lord']
            ];

            $_POST_timbre = [
                'nom'            => $_POST['nom'],
                'date_creation'  => $_POST['date_creation'],
                'couleur'        => $_POST['couleur'],
                'pays_origine'   => $_POST['pays_origine'],
                'tirage'         => $_POST['tirage'],
                'dimensions'     => $_POST['dimensions'],
                'certifie'       => $_POST['certifie'],
                'etat'           => $_POST['etat'],
                'utilisateur'    => $_POST['utilisateur_id']
            ];

            //  print_r($_POST_enchere);
            $oEnchere = new EnchereModele($_POST_enchere);
            $enchere_erreurs = $oEnchere->enchere_erreurs;

            $oTimbre = new TimbreModele($_POST_timbre);
            $timbre_erreurs = $oTimbre->timbre_erreurs;

            $oImage = new ImageModele($_FILES);
            $image_erreurs = $oImage->image_erreurs;


            if (count($enchere_erreurs) === 0) {
                $enchere_id = $this->oRequetesSQL->ajouterEnchere([
                    'date_debut'         => $oEnchere->date_debut,
                    'date_fin'           => $oEnchere->date_fin,
                    'prix_plancher'      => $oEnchere->prix_plancher,
                    'coup_de_coeur_lord' => $oEnchere->coup_de_coeur_lord,
                    'archive'            => $oEnchere->archive
                ]);
                $enchere_id = (int)$enchere_id;
            }

            if (count($timbre_erreurs) === 0 && $enchere_id) {
                // var_dump($this->oUtilConn->utilisateur_id);

                // var_dump('timbre', $oTimbre);
                //  $timbre_id = $this->oRequetesSQL->ajouterTimbre([
                // var_dump($timbre_erreurs);
                $timbre_id = $this->oRequetesSQL->ajouterTimbre([
                    'nom'            => $oTimbre->nom,
                    'date_creation'  => $oTimbre->date_creation,
                    'couleur'        => $oTimbre->couleur,
                    'pays_origine'   => $oTimbre->pays_origine,
                    'tirage'         => $oTimbre->tirage,
                    'dimensions'     => $oTimbre->dimensions,
                    'certifie'       => $oTimbre->certifie,
                    'etat'           => $oTimbre->etat,
                    'enchere_id'      => $enchere_id,
                    'utilisateur'     => $this->oUtilConn->utilisateur_id,

                ]);
                // var_dump('erreurs', $timbre_erreurs->nom);
                //  var_dump('100', $this->oUtilConn->utilisateur_id);
                $timbre_id = (int)$timbre_id;
            }
            //echo '<pre>';
            // var_dump($_FILES["userfile"]['tmp_name']);
            $this->oRequetesSQL->ajouterImage([
                // $_FILES;


                // 'image_url ' =>  $oImage->image_url,
                // 'timbre_id'  => $timbre_id

            ]);

            // $_FILES;
            // echo '<pre>';
            // print_r($_POST_image);

            //     [userfile] => Array
            // (
            //     [name] => mcd-21-4-19h45.png
            //     [type] => image/png
            //     [tmp_name] => /Applications/MAMP/tmp/php/php1uXulg
            //     [error] => 0
            //     [size] => 464841
            // )
        }

        new Vue(
            'vEnchereAjout',
            array(),
            'gabarit-frontend'
        );
    }


    public function validation()
    {
        echo 'enchere validation ici';
    }
}//fin classe

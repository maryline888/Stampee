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
        $this->utilisateur_id  = $_GET['utilisateur_id'] ?? null;
        $this->enchere_id  = $_GET['enchere_id'] ?? null;
        $this->oRequetesSQL = new RequetesSQL;
    }

    public function ajout()
    {

        $enchere_erreurs = [];
        $timbre_erreurs = [];

        $_POST_enchere = [];
        $_POST_timbre = [];
        $_POST_image = [];

        // si post is empty = il va montrer direct la vue vEnchereAjout

        if (!empty($_POST)) {


            $_POST_enchere = [
                'date_debut'         => $_POST['date_debut'],
                'date_fin'           => $_POST['date_fin'],
                'prix_plancher'      => $_POST['prix_plancher'],
                'coup_de_coeur_lord' => $_POST['coup_de_coeur_lord']
            ];

            $_POST_timbre = [
                //  'timbre_id'      => $_POST['timbre_id'],
                'nom'            => $_POST['nom'],
                'date_creation'  => $_POST['date_creation'],
                'couleur'        => $_POST['couleur'],
                'pays_origine'   => $_POST['pays_origine'],
                'tirage'         => $_POST['tirage'],
                'dimensions'     => $_POST['dimensions'],
                'certifie'       => $_POST['certifie'],
                'etat'           => $_POST['etat']
            ];
            //   var_dump($_POST_timbre);
            $_POST_image = [];

            //  print_r($_POST_enchere);
            $oEnchere = new EnchereModele($_POST_enchere);

            $enchere_erreurs = $oEnchere->enchere_erreurs;

            $oTimbre = new TimbreModele($_POST_timbre);
            //  $timbre_erreurs = $oTimbre->timbre_erreurs;


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
                //  var_dump($enchere_id);

                //  var_dump('timbre', $oTimbre);
                $timbre_id = $this->oRequetesSQL->ajouterTimbre([
                    'nom'            => $oTimbre->getNom(),
                    'date_creation'  => $oTimbre->getDate_creation(),
                    'couleur'        => $oTimbre->getCouleur(),
                    'pays_origine'   => $oTimbre->getPays_origine(),
                    'tirage'         => $oTimbre->getTirage(),
                    'dimensions'     => $oTimbre->getDimensions(),
                    'certifie'       => $oTimbre->getCertifie(),
                    'etat'           => $oTimbre->getEtat()
                ]);
                $timbre_id = (int)$timbre_id;
            }
        }

        new Vue(
            'vEnchereAjout',
            array(),
            'gabarit-frontend'
        );
    }
}//fin classe

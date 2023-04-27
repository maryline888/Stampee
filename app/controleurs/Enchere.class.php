<?php

class Enchere extends Routeur
{


    private $oUtilConn;
    private $image_id;
    private $enchere_id;
    private $utilisateur_id;
    private $erreurs;
    // private $erreurs_enchere;
    private $oEnchere;
    private $oTimbre;
    // private $erreurs_timbre;
    private $messageRetour;

    /**
     * Constructeur qui initialise des propriétés à partir du query string
     * et la propriété oRequetesSQL déclarée dans la classe Routeur
     * 
     */
    public function __construct()
    {
        $this->oUtilConn = $_SESSION['oUtilConn'] ?? null;

        $this->enchere_id;

        $this->oRequetesSQL = new RequetesSQL;
    }

    public function ajout()
    {

        $erreurs_enchere = [];
        $erreurs_timbre = [];
        $_POST_enchere = [];
        $_POST_timbre = [];


        // si post is empty = il va montrer direct la vue vEnchereAjout

        if (!empty($_POST)) {

            print_r($_POST);
            //condition erreur a ajouter
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

            $oEnchere = new EnchereModele($_POST_enchere);
            $erreurs_enchere = $oEnchere->erreurs;
            // print_r($erreurs_enchere);


            $oTimbre = new TimbreModele($_POST_timbre);
            $erreurs_timbre = $oTimbre->erreurs;

            $oImage = new ImageModele($_FILES);
            $erreur_image = $oImage->erreurs;

            $this->image_id = "";

            if (count($erreurs_enchere) === 0) {
                $enchere_id = $this->oRequetesSQL->ajouterEnchere([
                    'date_debut'         => $oEnchere->date_debut,
                    'date_fin'           => $oEnchere->date_fin,
                    'prix_plancher'      => $oEnchere->prix_plancher,
                    'coup_de_coeur_lord' => $oEnchere->coup_de_coeur_lord,
                    'archive'            => $oEnchere->archive,
                    'utilisateur_id'      => $this->oUtilConn->utilisateur_id,
                ]);
                $enchere_id = (int)$enchere_id;
            }

            if (count($erreurs_timbre) === 0 && $enchere_id) {

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
                $timbre_id = (int)$timbre_id;
            }

            if (isset($_FILES["userfile"])) {
                $file_name = $_FILES["userfile"]["name"];
                $file_tmp = $_FILES["userfile"]["tmp_name"];
                $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $image_name = uniqid() . '.' . $file_ext;
                $uploads_folder = __DIR__ . '/../../uploads/';
                $target_path = $uploads_folder . $image_name;
                if (!is_dir($uploads_folder)) {
                    mkdir($uploads_folder, 0755, true);
                }
                if (move_uploaded_file($file_tmp, $target_path)) {
                    // echo 'L\'image à bien été ajoutée.';
                    $this->image_id = $this->oRequetesSQL->ajouterImage([
                        'image_url' => $target_path,
                        'timbre_id' => $timbre_id
                    ]);
                } else {
                    // echo 'Un problème est survenu, veuillez recommencer.';
                }
            }

            // if (count($erreur_image) == 0) {
            //     $this->validation();
            // }
        }
        // app/vues/templates/vEnchere/vEnchereAjout.twig
        new Vue(
            'vEncheres/vEnchereAjout',
            array(
                //cle valeur
                'oUtilConn' => $this->oUtilConn,
                'erreurs_timbre' => $erreurs_timbre,
                'erreurs_enchere' => $erreurs_enchere,
                'oEnchere' => $this->oEnchere,
                'oTimbre' => $this->oTimbre

            ),
            'vGabarits/gabarit-frontend'
        );
    }

    public function validation()
    {

        new Vue(
            'vEncheres/vEnchereValidation',
            array(
                'oUtilConn' => $this->oUtilConn,
                'oEnchere' => $this->oEnchere,
                'oTimbre' => $this->oTimbre

            ),
            'vGabarits/gabarit-frontend'
        );
    }
}//fin classe
 <?php
    class Timbre extends Routeur
    {
        private $oUtilConn;
        private $timbre_erreurs;
        private $timbre;
        private $enchere_id;


        public function __construct($enchere_id, $_POST_timbre)
        {
            $this->oUtilConn = $_SESSION['oUtilConn'] ?? null;
            $this->timbre  = $_POST_timbre;
            $this->enchere_id = $enchere_id;
            $this->oRequetesSQL = new RequetesSQL;
        }

        public function ajouterTimbre($enchere_id)
        {

            var_dump('ajoutTimbre', $enchere_id);
            var_dump('post Timbre', $this->timbre);
            $timbre_erreurs = [];

            // if (count($timbre_erreurs) === 0 && $enchere_id) {
            // }
        }
    }

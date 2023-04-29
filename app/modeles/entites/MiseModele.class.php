<?php

/**
 * Classe pour le modèle de l'entité mise
 *
 */
class MiseModele
{

    private $utilisateur_id; //fk 
    private $enchere_id; //fk
    private $montant;
    private $offre_actuelle;
    private $date_mise;
    private $erreurs;

    /**
     * Constructeur de la classe 
     * @param array $proprietes, tableau associatif des propriétés 
     */
    public function __construct($proprietes = [])
    {
        $t = array_keys($proprietes);
        foreach ($t as $nom_propriete) {
            $this->__set($nom_propriete, $proprietes[$nom_propriete]);
        }
    }

    /**
     * Accesseur magique d'une propriété de l'objet
     * @param string $prop, nom de la propriété
     * @return property value
     */
    public function __get($prop)
    {
        return $this->$prop;
    }

    /**
     * Mutateur magique qui exécute le mutateur de la propriété en paramètre 
     * @param string $prop, nom de la propriété
     * @param $val, contenu de la propriété à mettre à jour
     */
    public function __set($prop, $val)
    {
        $setProperty = 'set' . ucfirst($prop);
        $this->$setProperty($val);
    }
    public function getMise_id()
    {
        return $this->mise_id;
    }
    public function getUtilisateur_id()
    {
        return $this->utilisateur_id;
    }

    public function getEnchere_id()
    {
        return $this->enchere_id;
    }

    public function getMontant()
    {
        return $this->montant;
    }

    public function getDate_mise()
    {
        return $this->date_mise;
    }
    public function getErreurs()
    {
        return $this->erreurs;
    }

    // setters
    public function setMise_id($mise_id)
    {
        unset($this->erreurs['mise_id']);


        $this->mise_id = $mise_id;
        return $this;
    }
    public function setUtilisateur_id($utilisateur_id)
    {
        unset($this->erreurs['utilisateur_id']);


        $this->utilisateur_id = $utilisateur_id;
        return $this;
    }

    public function setEnchere_id($enchere_id)
    {
        unset($this->erreurs['enchere_id']);


        $this->enchere_id = (int)$enchere_id;
        return $this;
    }

    public function setMontant($montant)
    {
        unset($this->erreurs['montant']);
        $montant = strval($montant);
        $montant = str_replace(',', '.', $montant);
        $montant = (float)$montant;
        if (!$montant) {
            $this->erreurs['montant'] = "Veuillez inscrire un montant avant de miser";
        }
        $this->montant = $montant;
        return $this;
    }

    public function setDate_mise($date_mise)
    {
        unset($this->date_mise['date_mise']);
        if (!$date_mise) {
            $this->erreurs['date_mise'] = 'erreur';
        }
        $this->date_mise = date('Y-m-d H:i:s');
        return $this;
    }
}//fin class
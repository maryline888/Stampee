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
    private $gagnant;
    private $offre_actuelle;
    private $quantite_mises;
    private $date_mise;

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

    public function getGagnant()
    {
        return $this->gagnant;
    }

    public function getOffre_actuelle()
    {
        return $this->offre_actuelle;
    }

    public function getQuantite_mises()
    {
        return $this->quantite_mises;
    }

    public function getDate_mise()
    {
        return $this->date_mise;
    }

    // setters

    public function setUtilisateur_id($utilisateur_id)
    {
        unset($this->erreurs['utilisateur_id']);


        $this->utilisateur_id = $utilisateur_id;
        return $this;
    }

    public function setEnchere_id($enchere_id)
    {
        unset($this->erreurs['enchere_id']);


        $this->enchere_id = $enchere_id;
        return $this;
    }

    public function setMontant($montant)
    {
        unset($this->erreurs['montant']);
        $montant = (int)$montant;
        $montant = trim($montant);
        $montant = str_replace(',', '.', $montant);
        if (!$montant) {
            $this->erreurs['montant'] = "Veuillez inscrire un montant avant de miser";
        }
        $this->montant = $montant;
        return $this;
    }

    public function setGagnant($gagnant)
    {
        unset($this->gagnant['gagnant']);


        $this->gagnant = $gagnant;
        return $this;
    }

    public function setOffre_actuelle($offre_actuelle)
    {
        unset($this->offre_actuelle['offre_actuelle']);


        $this->offre_actuelle = $offre_actuelle;
        return $this;
    }

    public function setQuantite_mises($quantite_mises)
    {
        unset($this->quantite_mises['quantite_mises']);


        $this->quantite_mises = $quantite_mises;
        return $this;
    }

    public function setDate_mise($date_mise)
    {
        unset($this->date_mise['date_mise']);


        $this->date_mise = $date_mise;
        return $this;
    }
}//fin class
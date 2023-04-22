<?php

/**
 * Classe pour le modèle de l'entité Enchère
 */

class EnchereModele
{

    private $enchere_id;
    private $date_debut;
    private $date_fin;
    private $prix_plancher;

    private $coup_de_coeur_lord;
    private $timbre_id;
    private $archive;

    private $erreurs = [];

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

    // getters pour exploitation necessaire a twig
    public function getEnchere_id()
    {
        return $this->enchere_id;
    }

    public function getEnchere_date_debut()
    {
        return $this->enchere_date_debut;
    }

    public function getEnchere_date_fin()
    {
        return $this->enchere_date_fin;
    }

    public function getEnchere_prix_plancher()
    {
        return $this->enchere_prix_plancher;
    }

    public function getEnchere_coup_de_coeur_lord()
    {
        return $this->enchere_coup_de_coeur_lord;
    }

    public function getEnchere_timbre_id()
    {
        return $this->enchere_timbre_id;
    }

    public function getEnchere_archive()
    {
        return $this->enchere_archive;
    }

    public function getErreurs()
    {
        return $this->erreurs;
    }

    /**
     * Mutateur de la propriété enchere id
     * @param int $utilisateurid
     * @return $this
     */
    public function setEnchere_id($enchere_id)
    {
        $this->enchere_id = $enchere_id;

        return $this;
    }

    /**
     * Mutateur de la propriété date_debut
     * @param int $date_debut
     * @return $this
     */
    public function setDate_debut($date_debut)
    {
        unset($this->erreurs['date_debut']);
        $this->date_debut = $date_debut;
        return $this;
    }

    /**
     * Mutateur de la propriété date_fin
     * @param int $date_fin
     * @return $this
     */
    public function setDate_fin($date_fin)
    {
        unset($this->erreurs['date_fin']);

        $this->date_fin = $date_fin;

        return $this;
    }
    /**
     * Mutateur de la propriété prix_plancher
     * @param int $prix_plancher
     * @return $this
     */
    public function setPrix_plancher($prix_plancher)
    {
        unset($this->erreurs['prix_plancher']);

        if (preg_match('/^\d+(\.\d{1,2})?$/', $prix_plancher)) {
            return true;
        } else {
            return false;
        }
        $this->prix_plancher = $prix_plancher;

        return $this;
    }
    /**
     * Mutateur de la propriété coup_de_coeur_lord
     * @param int $coup_de_coeur_lord
     * @return $this
     */
    public function setCoup_de_coeur_lord($coup_de_coeur_lord)
    {
        unset($this->erreurs['coup_de_coeur_lord']);

        $this->coup_de_coeur_lord = $coup_de_coeur_lord;

        return $this;
    }
    /**
     * Mutateur de la propriété coup_de_coeur_lord
     * @param int $coup_de_coeur_lord
     * @return $this
     */
    public function setTimbre_id($timbre_id)
    {
        unset($this->erreurs['timbre_id']);
        $this->timbre_id = $timbre_id;

        return $this;
    }
    /**
     * Mutateur de la propriété coup_de_coeur_lord
     * @param int $coup_de_coeur_lord
     * @return $this
     */
    public function setArchive($archive)
    {
        unset($this->erreurs['archive']);
        $this->archive = $archive;

        return $this;
    }
}//fin class
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
    private $archive;
    private $utilisateur;

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

    public function getDate_debut()
    {
        return $this->date_debut;
    }

    public function getDate_fin()
    {
        return $this->date_fin;
    }

    public function getPrix_plancher()
    {
        return $this->prix_plancher;
    }

    public function getCoup_de_coeur_lord()
    {
        return $this->coup_de_coeur_lord;
    }

    public function getArchive()
    {
        return $this->archive;
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
        if (!$date_debut) {
            $this->erreurs['date_debut'] = "Veuillez choisir une date";
        }
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
        if (!$date_fin) {
            $this->erreurs['date_fin'] = "Veuillez choisir une date";
        }
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

        $prix_plancher = str_replace(',', '.', $prix_plancher);

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
     * Mutateur de la propriété archive
     * @param int $archive
     * @return $this
     */
    public function setArchive($archive)
    {
        unset($this->erreurs['archive']);
        if ($archive == null || $archive == false) {
            $archive = 0;
        }
        $this->archive = $archive;

        return $this;
    }
}//fin class
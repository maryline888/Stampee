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

    // public function getErreurs()
    // {
    //     return $this->erreurs;
    // }

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
        // if (!isset($date_debut) || strtotime($date_debut) === false) {
        //     $this->erreurs['date_debut'] = 'La date de début de est invalide.';
        // } elseif (strtotime($date_debut) < strtotime(date('Y-m-d'))) {
        //     $this->erreurs['date_debut'] = 'La date de début ne peut pas être avant à la date actuelle.';
        // } elseif (strtotime($date_debut) < strtotime($this->date_debut)) {
        //     $this->erreurs['date_debut'] = 'La date de fin de ne peut pas être avant à la date de début.';
        // }
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
        // if (!isset($date_fin) || strtotime($date_fin) === false) {
        //     $this->erreurs['date_fin'] = 'La date de fin de est invalide.';
        // } elseif (strtotime($date_fin) < strtotime(date('Y-m-d'))) {
        //     $this->erreurs['date_fin'] = 'La date de fin ne peut pas être avant à la date actuelle.';
        // } elseif (strtotime($date_fin) < strtotime($this->date_fin)) {
        //     $this->erreurs['date_fin'] = 'La date de fin de ne peut pas être avant à la date de début.';
        // }
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
        $regex = '/\d+([.,]\d{1,2})?/';
        if (!preg_match($regex, $prix_plancher)) {
            $this->erreurs['prix_plancher'] = "Svp inscrire le montant dans ce format : ex 12.45";
        }
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

        $this->archive = $archive;

        return $this;
    }
}//fin class
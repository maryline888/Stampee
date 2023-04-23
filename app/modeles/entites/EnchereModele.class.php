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

    private $enchere_erreurs = [];

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
        return $this->date_debut;
    }

    public function getEnchere_date_fin()
    {
        return $this->date_fin;
    }

    public function getEnchere_prix_plancher()
    {
        return $this->prix_plancher;
    }

    public function getEnchere_coup_de_coeur_lord()
    {
        return $this->coup_de_coeur_lord;
    }

    public function getEnchere_archive()
    {
        return $this->archive;
    }

    public function getErreurs()
    {
        return $this->enchere_erreurs;
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
        unset($this->enchere_erreurs['date_debut']);
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
        unset($this->enchere_erreurs['date_fin']);

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
        unset($this->enchere_erreurs['prix_plancher']);

        $prix_plancher = str_replace(',', '.', $prix_plancher);

        // Valider la valeur comme un nombre au format monétaire
        // if (filter_var($prix_plancher, FILTER_VALIDATE_FLOAT) !== false) {
        //     echo 'La valeur est un nombre au format monétaire valide.';
        // } else {
        //     echo 'La valeur n\'est pas un nombre au format monétaire valide.';
        // }
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
        unset($this->enchere_erreurs['coup_de_coeur_lord']);

        $this->coup_de_coeur_lord = $coup_de_coeur_lord;

        return $this;
    }

    /**
     * Mutateur de la propriété coup_de_coeur_lord
     * @param int $coup_de_coeur_lord
     * @return $this
     */
    public function setArchive($archive)
    {
        unset($this->enchere_erreurs['archive']);
        $this->archive = $archive;

        return $this;
    }
}//fin class
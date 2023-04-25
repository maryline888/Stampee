<?php

/**
 * Classe pour le modèle de l'entité timbre
 *
 */
class ImageModele
{

    private $image_id;
    private $image_url;
    private $timbre_id;
    private $userfile;
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

    public function getImage_id()
    {
        return $this->image_id;
    }
    public function getImage_url()
    {
        return $this->image_url;
    }
    public function getTimbre_id()
    {
        return $this->timbre_id;
    }
    public function getErreurs()
    {
        return $this->erreurs;
    }
    public function getUserfile()
    {
        return $this->userfile;
    }

    public function setUserfile($userfile)
    {
        unset($this->erreurs['userfile']);
        $this->erreurs = $userfile;
        return $this;
    }

    public function setImage_id($image_id)
    {
        unset($this->erreurs['image_id']);

        //   $regExp = '/^.+$/';
        //   if (!preg_match($regExp, $nom)) {
        //     $this->timbre_erreurs['nom'] = 'Au moins un caractère.';
        //   }
        $this->image_id = $image_id;
        return $this;
    }

    public function setImage_url($image_url)
    {
        unset($this->erreurs['image_url']);

        //   $regExp = '/^.+$/';
        //   if (!preg_match($regExp, $nom)) {
        //     $this->timbre_erreurs['nom'] = 'Au moins un caractère.';
        //   }
        $this->image_url = $image_url;
        return $this;
    }




    public function setTimbre_id($timbre_id)
    {
        unset($this->erreurs['timbre_id']);
        $regExp = '/^[1-9]\d*$/';
        if (!preg_match($regExp, $timbre_id)) {
            $this->erreurs['timbre_id'] = 'Numéro de timbre incorrect.';
        }
        $this->erreurs = $timbre_id;
        return $this;
    }
}

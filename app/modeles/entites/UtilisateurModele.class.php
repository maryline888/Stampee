<?php

/**
 * Classe de l'entité Utilisateur
 *
 */
class UtilisateurModele
{
    private $utilisateur_id;
    private $utilisateur_nom;
    private $utilisateur_prenom;
    private $utilisateur_courriel;
    private $utilisateur_adresse;
    private $utilisateur_mdp;
    private $role_id;

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
    public function getUtilisateur_id()
    {
        return $this->utilisateur_id;
    }

    public function getUtilisateur_nom()
    {
        return $this->utilisateur_nom;
    }

    public function getUtilisateur_prenom()
    {
        return $this->utilisateur_prenom;
    }

    public function getUtilisateur_courriel()
    {
        return $this->utilisateur_courriel;
    }

    public function getUtilisateur_adresse()
    {
        return $this->utilisateur_adresse;
    }

    public function getUtilisateur_mdp()
    {
        return $this->utilisateur_mdp;
    }

    public function getUtilisateur_roleid()
    {
        return $this->role_id;
    }

    public function getErreurs()
    {
        return $this->erreurs;
    }




    /**
     * Mutateur de la propriété utilisateurid 
     * @param int $utilisateurid
     * @return $this
     */
    public function setUtilisateur_id($utilisateurid)
    {
        $this->utilisateur_id = $utilisateurid; //doit etre complété par les controles nécessaires à la saisie
    }

    /**
     * Mutateur de la propriété utilisateurnom 
     * @param string $utilisateurnom
     * @return $this
     */
    public function setUtilisateur_nom($nom)
    {
        unset($this->erreurs['utilisateur_nom']);
        $nom = trim($nom);
        $regExp = '/^[a-zÀ-ÖØ-öø-ÿ]{2,}( [a-zÀ-ÖØ-öø-ÿ]{2,})*$/i';
        // $regExp = '/^\p{L}{2,}( \p{L}{2,})*$/ui'; // regexp équivalente à la précédente
        if (!preg_match($regExp, $nom)) {
            $this->erreurs['utilisateur_nom'] = "Au moins 2 caractères alphabétiques pour chaque mot.";
        }
        $this->utilisateur_nom = $nom;
        return $this;
    }

    /**
     * Mutateur de la propriété utilisateurprenom 
     * @param string $utilisateurprenom
     * @return $this
     */

    public function setUtilisateur_prenom($utilisateur_prenom)
    {
        unset($this->erreurs['utilisateur_prenom']);
        $utilisateur_prenom = trim($utilisateur_prenom);
        $regExp = '/^[\p{L}-]+(?:\s[\p{L}-]+)*$/u';
        if (!preg_match($regExp, $utilisateur_prenom)) {
            $this->erreurs['utilisateur_prenom'] = "PRENOM : Au moins 2 caractères alphabétiques pour chaque mot.";
        }
        $this->utilisateur_prenom = $utilisateur_prenom;
        return $this;
    }

    /**
     * Mutateur de la propriété utilisateurprenom 
     * @param string $utilisateurcourriel
     * @return $this
     */
    public function setUtilisateur_courriel($utilisateur_courriel)
    {
        unset($this->erreurs['utilisateur_courriel']);
        $utilisateur_courriel = trim($utilisateur_courriel);
        // $regExp = '/^[a-zÀ-ÖØ-öø-ÿ]{2,}( [a-zÀ-ÖØ-öø-ÿ]{2,})*$/i';
        $regExp = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'; // regexp équivalente à la précédente
        if (!preg_match($regExp, $utilisateur_courriel)) {
            $this->erreurs['utilisateur_courriel'] = "COURRIEL : Au moins 2 caractères alphabétiques pour chaque mot.";
        }
        $this->utilisateur_courriel = $utilisateur_courriel;
        return $this;
    }

    /**
     * Mutateur de la propriété utilisateurmdp
     * @param string $utilisateurmdp
     * @return $this
     */
    public function setUtilisateur_mdp($utilisateur_mdp)
    {
        unset($this->erreurs['utilisateur_mdp']);
        $utilisateur_mdp = trim($utilisateur_mdp);
        $regExp = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[%!:=])[A-Za-z\d%!:=]{7,}$/';
        if (!preg_match($regExp, $utilisateur_mdp)) {
            $this->erreurs['utilisateur_mdp'] = "Votre mot de passe doit comporter au minimum 7 caractères avec 1 majuscule, 1 minuscule, 1 chiffre et l'un des caractères spécial.";
        }
        $this->utilisateur_mdp = $utilisateur_mdp;
        return $this;
    }


    public function setUtilisateur_adresse($utilisateur_adresse)
    {
        unset($this->erreurs['utilisateur_adresse']);
        $utilisateur_adresse = trim($utilisateur_adresse);
        // $regExp = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[%!:=])[A-Za-z\d%!:=]{7,}$/';
        // if (!preg_match($regExp, $utilisateur_adresse)) {
        // }

        if (!$utilisateur_adresse) {

            $this->erreurs['utilisateur_adresse'] = "votre adresse ne peut être vide.";
        }
        $this->utilisateur_adresse = $utilisateur_adresse;
        return $this;
    }

    /**
     * Mutateur de la propriété $role_id
     * @param string $role_id
     * @return $this
     */
    public function setRole_id($role_id)
    {

        unset($this->erreurs['utilisateur.role_id']);
        $role_id = intval($role_id);
        $this->role_id = $role_id;
        return $this;
    }
}

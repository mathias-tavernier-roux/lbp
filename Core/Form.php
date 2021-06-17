<?php
namespace App\Core;

class Form  
{
    private $formCode = '';
    
    /**
     * Génère le formulaire Html
     *
     * @return void
     */
    public function create()
    {
        return $this->formCode;
    }

    /**
     * On valide si tout les champs proposés sont remplis
     *
     * @param array $form Tableau issu du formulaire ($_POST)
     * @param array $champs Tableau listant les champs obligatoires
     * @return bool
     */
    public static function validate(array $form, array $champs)
    {
        // On parcours les champs
        foreach ($champs as $champ) {
            if (!isset($form[$champ]) OR empty($form[$champ])) {
                // On sort en retournant false
                return false;
            }
        
        }
        return true;
    }

    /**
     * Ajoute les attributs envoyés à la balise
     *
     * @param array $attributs Tableau associatif
     * @return string Chaine de caractères générée
     */
    public function ajoutAttributs(array $attributs): string
    {
        // On initialise une chaine de caractère
        $str = '';

        // On liste les attributs "courts"
        $courts = ['checked', 'disabled', 'readonly', 'multiple', 'required', 'autofocus', 'novalidate', 'formovalidate'];

        //On boucle sur le tableau d'attributs
        foreach ($attributs as $attribut => $valeur) {
            // Si l'attribut est dans la liste des attributs courts
            if(in_array($attribut, $courts) AND $valeur == true){
                $str .= " $attribut";
            }else{
                // On ajoute attribut='valeur'
                $str .= " $attribut='$valeur'";
            }
        }
        return $str;
    }

    /**
     * Balise d'ouverture du formulaire
     *
     * @param string $method Méthode du formulaire post ou get
     * @param string $action Action du formulaire
     * @param array $attributs  Attributs
     * @return Form
     */
    public function debutForm(string $method = 'post', string $action = '#', array $attributs = []): self
    {
        // On crée la balise form
        $this->formCode .= "<form action='$action' method='$method'";

        // On ajoute les attributs éventuels      
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs).'>' : '>';
        
        return $this;
    }

    /**
     * Balise de fermeture du formulaire
     *
     * @return Form
     */
    public function finForm(): self
    {
        $this->formCode .= '</form>';
        return $this;
    }

    /**
     * Création du label
     *
     * @param string $for for
     * @param string $text texte à l'intérieur du label (visible)
     * @param array $attributs attributs eventuelles (required, class.....)
     * @return self
     */
    public function ajoutLabelFor(string $for, string $text, array $attributs = []): self
    {
        // On ouvre la balise

        $this->formCode .= "<label for='$for'";
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) : '';
        $this->formCode .= ">$text</label>";
        return $this;
    }

    /**
     * Création d'un input
     *
     * @param string $type type de l'input
     * @param string $nom Nom de l'input
     * @param array $attributs Si attributs passer les attributs (class, required.....)
     * @return self
     */
    public function ajoutInput(string $type, string $nom, array $attributs = []): self
    {
        $this->formCode .= "<input type='$type' name='$nom'";
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs).'>' : '>';
        return $this;
    }

    /**
     * Création d'un textarea
     *
     * @param string $nom
     * @param string $valeur
     * @param array $attributs
     * @return self
     */
    public function ajoutTextarea(string $nom, string $valeur = '', array $attributs = []): self
    {
        // On ouvre la balise

        $this->formCode .= "<textarea name='$nom'";
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) : '';
        $this->formCode .= ">$valeur</textarea>";
        return $this;
    }

    public function ajoutSelect(string $nom, array $options, array $attributs = []): self
    {
        $this->formCode .= "<select name='$nom";
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs). '>' : '>';

        foreach ($options as $valeur => $texte) {
            $this->formCode .= "<option value='$valeur'>$texte</option>";
        }

        $this->formCode .= '</select>';
        
        return $this;
    }

    public function ajoutBouton(string $texte, array $attributs = []): self
    {
        $this->formCode .= '<button';
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) : '';
        $this->formCode .= ">$texte</button>";

        return $this;
    }
}